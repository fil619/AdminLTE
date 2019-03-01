<template>
  <button type="button" @click="notify">Show notification</button>
</template>

<script>
export default {
  methods: {
    notify () {

      this.$notification.show('Hello World', {
        body: 'This is an example!'
      }, {})
    }
  }
}
</script>

<style>
</style>
