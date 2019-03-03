<template>
  <v-app>
  <div>
      <v-tabs
        slot="extension"
        v-model="tab"
        grow
      >
        <v-tabs-slider color="yellow"></v-tabs-slider>

        <v-tab
          v-for="item in items"
          :key="item"
        >
          {{ item }}
        </v-tab>
      </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item
      color="white"
        v-for="item in items"
        :key="item"
      >
        <v-card flat>
          <v-card-text>{{ text }}</v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </div>
</v-app>
</template>

<script>
  export default {
    data () {
      return {
        tab: null,
        items: [
          'Day Report', 'Month Report', 'Attendance Report'
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
      }
    }
  }
</script>
