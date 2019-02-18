<template>
  <div>
    <md-content class="primary">
<Expenses></Expenses>
    </md-content>
    <md-content class="accent">
      <DisplayExpenses></DisplayExpenses>
    </md-content>
  </div>
</template>

<style lang="scss" scoped>
  .primary {
    width: 60%;
    height: 550px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
  }
   .accent {
      width: 39%;
      height: 550px;
      display: inline-flex;
      justify-content: center;
      align-items: center;
    }
</style>

<script>
export default {
  name: 'PaperContent'
}
</script>
