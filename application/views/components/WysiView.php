<template id="WysiComponent">
  <div class="ui-wysi" @change="handleInput">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <textarea :id="id_"
    class="form-control"
    :placeholder="placeholder"
    :rows="size"
    :disabled="disabled || loading"></textarea>

  </div>
</template>

<script>
  Vue.component('ui-wysi', {
    template: '#WysiComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      value: {
        type: String,
        default: '',
      },

      placeholder: {
        type: String,
        default: '',
      },

      size: {
        type: String,
        default: '24',
      },

      disabled: {
        type: Boolean,
        default: false,
      },

      loading: {
        type: Boolean,
        default: false,
      },

      menubar: {
        type: Boolean,
        default: false,
      },

      plugins: {
        type: Array,
        default: () => [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code codesample code'
        ],
      },

      toolbar: {
        type: String,
        default: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image codesample code',
      },

    },

    /************************
    <id="_data">
    ************************/
    data: function () {
      return {
        id_: 'wysi-' + Math.floor(100000 + Math.random() * 900000),
        browse: false,
        clicked: false,
        mediaFile: '',
      };
    },

    /************************
    <id="_mounted">
    ************************/
    mounted: function () {

      tinymce.init({
        selector: '#' + this.id_,
        // height: 500,
        menubar: this.menubar,
        plugins: this.plugins,
        toolbar: this.toolbar,

        automatic_uploads: true,
        file_picker_types: 'image',
        // and here's our custom image picker
        file_picker_callback: function(cb, value, meta) {
          var input = document.createElement('input');
          input.setAttribute('type', 'file');
          input.setAttribute('accept', 'image/*');

          // Note: In modern browsers input[type="file"] is functional without
          // even adding it to the DOM, but that might not be the case in some older
          // or quirky browsers like IE, so you might want to add it to the DOM
          // just in case, and visually hide it. And do not forget do remove it
          // once you do not need it anymore.

          input.onchange = function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
              // Note: Now we need to register the blob in TinyMCEs image blob
              // registry. In the next release this part hopefully won't be
              // necessary, as we are looking to handle it internally.
              var id = 'blobid' + (new Date()).getTime();
              var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
              var base64 = reader.result.split(',')[1];
              var blobInfo = blobCache.create(id, file, base64);
              blobCache.add(blobInfo);

              // call the callback and populate the Title field with the file name
              cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
          };

          input.click();
        },

        setup: function(editor) {
          editor.on('keyup', this.handleInput.bind(this));
          editor.on('change', this.handleInput.bind(this));

          // editor.on('init', this.handleInit.bind(this));
          editor.on('click', this.handleInit.bind(this));
        }.bind(this),
      });

    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_handleInit">
      ************************/
      handleInit: function () {

        if (!this.clicked) {
          tinymce.activeEditor.setContent(this.value);
          this.clicked = true;
        }
      },

      /************************
      <id="_handleInput">
      ************************/
      handleInput: function (event) {
        var value = tinymce.activeEditor.getContent();
        value = encodeURIComponent(value);

        this.$emit('input', value);
      },

    },

  });
</script>
