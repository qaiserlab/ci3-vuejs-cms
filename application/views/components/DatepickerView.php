<template id="DatepickerComponent">
  <div class="ui-datepicker">

    <label v-if="this.$slots.default">
      <slot></slot>
    </label>

    <span v-if="type == 'daily'">
      <select class="form-control"
      @input="handleInputDay"
      :value="dayValue"
      :disabled="disabled || loading">
        <option v-for="day in days"
        :selected="day == dayValue">{{ day }}</option>
      </select>

      <select class="form-control"
      @input="handleInputMonth"
      :value="monthValue"
      :disabled="disabled || loading">
        <option v-for="(month, index) in months"
        :value="index + 1"
        :selected="(index + 1) == monthValue">{{ month }}</option>
      </select>

      <select class="form-control"
      @input="handleInputYear"
      :value="yearValue"
      :disabled="disabled || loading">
        <option v-for="year in years"
        :selected="year == yearValue">{{ year }}</option>
      </select>
    </span>

    <span v-if="type == 'monthly'">

      <select class="form-control"
      @input="handleInputYear"
      :value="yearValue"
      :disabled="disabled || loading">
        <option v-for="year in years"
        :selected="year == yearValue">{{ year }}</option>
      </select>

      <select class="form-control"
      @input="handleInputMonth"
      :value="monthValue"
      :disabled="disabled || loading">
        <option v-for="(month, index) in months"
        :value="index + 1"
        :selected="(index + 1) == monthValue">{{ month }}</option>
      </select>

    </span>

    <span v-if="type == 'yearly'">
      <select class="form-control"
      @input="handleInputYear"
      :value="yearValue"
      :disabled="disabled || loading">
        <option v-for="year in years"
        :selected="year == yearValue">{{ year }}</option>
      </select>
    </span>

  </div>
</template>

<script>
  Vue.component('ui-datepicker', {
    template: '#DatepickerComponent',

    /************************
    <id="_props">
    ************************/
    props: {

      value: {
        type: String,
        default: '2011-1-1',
      },

      type: {
        type: String,
        default: 'daily',
      },

      disabled: {
        type: Boolean,
        default: false,
      },

      loading: {
        type: Boolean,
        default: false,
      },

    },

    /************************
    <id="_computed">
    ************************/
    computed: {

      /************************
      <id="_dayValue">
      ************************/
      dayValue: function () {
        var xValue = this.value.split('-');
        return xValue[2];
      },

      /************************
      <id="_monthValue">
      ************************/
      monthValue: function () {
        var xValue = this.value.split('-');
        return xValue[1];
      },

      /************************
      <id="_yearValue">
      ************************/
      yearValue: function () {
        var xValue = this.value.split('-');
        return xValue[0];
      },

      /************************
      <id="_days">
      ************************/
      days: function () {
        var days = [];

        for (var i = 1; i <= 31; i++) {
          days.push(i);
        }

        return days;
      },

      /************************
      <id="_months">
      ************************/
      months: function () {
        return [
          '<?= lang('JANUARY') ?>',
          '<?= lang('FEBRUARY') ?>',
          '<?= lang('MARCH') ?>',
          '<?= lang('APRIL') ?>',
          '<?= lang('MAY') ?>',
          '<?= lang('JUNE') ?>',
          '<?= lang('JULY') ?>',
          '<?= lang('AUGUST') ?>',
          '<?= lang('SEPTEMBER') ?>',
          '<?= lang('OCTOBER') ?>',
          '<?= lang('NOVEMBER') ?>',
          '<?= lang('DECEMBER') ?>',
        ];
      },

      /************************
      <id="_years">
      ************************/
      years: function () {
        var years = [];

        for (var i = 1985; i <= 2047; i++) {
          years.push(i);
        }

        return years;
      },
    },

    /************************
    <id="_methods">
    ************************/
    methods: {

      /************************
      <id="_handleInputDay">
      ************************/
      handleInputDay: function (event) {
        var value = this.yearValue + '-' + this.monthValue + '-' + event.target.value;
        this.$emit('input', value);
      },

      /************************
      <id="_handleInputMonth">
      ************************/
      handleInputMonth: function (event) {
        var value = this.yearValue + '-' + event.target.value + '-' + this.dayValue;
        this.$emit('input', value);
      },

      /************************
      <id="_handleInputYear">
      ************************/
      handleInputYear: function (event) {
        var value = event.target.value + '-' + this.monthValue + '-' + this.dayValue;
        this.$emit('input', value);
      },

    },

  });
</script>
