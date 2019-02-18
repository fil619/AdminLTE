<template>
  <div>
      <md-tabs class="md-transparent" md-alignment="fixed">
        <md-tab id="tab-home" md-label="Direct"><DispDirect></DispDirect></md-tab>
        <md-tab id="tab-pages" md-label="Indirect"><DispInDirect></DispInDirect></md-tab>
      </md-tabs>

  </div>
</template>

<script>
export default {
  name: 'TabContent'
}
</script>
