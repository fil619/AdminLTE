<template>
<v-app>
  <div style="padding-top:10px">
 <div class="headline font-weight-black" style="color:#B71C1C">
 <i class="fas fa-cart-plus" ></i> Add Additional Payment
</div>
  <v-divider></v-divider>
  <v-container fluid>

    <v-layout justify-center>
    <v-flex md8 sm8>
      <v-form
         ref="form"
         v-model="valid"
         lazy-validation
       >
      <v-select
      label="Select"
      :rules="[  v => !!v || 'Select an Employee']"
      v-bind:items="staff"
      v-model="employee"
      item-text="`${data.item.name}  ${data.item.group}`"
      item-value="employee_id"
      autofocus
    >
      <template slot="selection" slot-scope="data">
        {{ data.item.first_name}} {{data.item.last_name}}
      </template>
      <template slot="item" slot-scope="data">
          <v-list-tile-content>
            <v-list-tile-title v-html="`${data.item.first_name} ${data.item.last_name}`">
            </v-list-tile-title>
            <v-list-tile-sub-title v-html="data.item.type"></v-list-tile-sub-title>
          </v-list-tile-content>
        </template>
    </v-select>

    <v-text-field
        v-model="vehicle"
         label="Vehicle No"
         mask="AA-##-A-####"
    ></v-text-field>

      <v-text-field
          v-model="amount"
           label="Amount"
           type="number"
           :rules="[  v => !!v || 'Amount is required']"
      ></v-text-field>

      <v-text-field
           v-model="workedon"
           label="Worked On"
           type="date"
           :rules="[  v => !!v || 'Date is required']"
         ></v-text-field>

         <v-text-field
          v-model="work"
           label="Work Done"
           :rules="[  v => !!v || 'Mention the Work Done']"
       ></v-text-field>

       <center><v-btn color="success" @click="submit">Submit</v-btn></center>
 </v-form>
    </v-flex>
  </v-layout>
  </v-container>
</div>
</v-app>
</template>

<script>
export default {
  mounted()
  {
    this.getstaff();
  },
  data(){
      return {
    staff:[],
    vehicle:'',
    amount:'',
    workedon:new Date().toISOString().substr(0, 10),
    work:'',
    employee:'',
    valid: true
      }
  },
  methods:
  {
    submit () {
      if (this.$refs.form.validate()) {
        axios.post('/additional', {
          emp_id:this.employee ,
          vehicle:this.vehicle ,
          date:this.workedon +' 00:00:00' ,
          amount:this.amount ,
          work:this.work ,
})
this.$refs.form.reset();

      }
    },
    getstaff()
    {
      axios.get('/employee/staff').then(response => {
        this.staff = response.data  ;
       })
    }
  }
}
</script>

<style lang="css" scoped>
.v-btn:focus {
  background-color: yellow !important;
  color: black !important ;
}
</style>
