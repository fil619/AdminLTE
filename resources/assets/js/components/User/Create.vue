<template>
  <v-app>
  <v-layout>
    <v-flex xs12 sm12 md10 offset-md1>
      <v-card>

        <v-card-title style="background-color:#0d47a1 ; color:white">
          <i class="nav-icon fas fa-users fa-2x"></i>
           <span class="title font-weight-light">ADD NEW EMPLOYEE</span>
         </v-card-title>

         <v-flex xs12 sm12 md10 offset-md1>
         <v-form
             ref="form"
             v-model="valid"
             lazy-validation
           >
           <v-text-field
             v-model="empid"
             :rules="[  v => !!v || 'Employee ID is required']"
             label="Employee ID(*)"
             required
           ></v-text-field>

             <v-text-field
               v-model="firstname"
               :rules="nameRules"
               label="First Name(*)"
               :counter="30"
               required
             ></v-text-field>

             <v-text-field
               v-model="lastname"
               :rules="nameRules"
               label="Last Name(*)"
               :counter="30"
               required
             ></v-text-field>

             <v-text-field
               v-model="dob"
               type = "date"
               :rules="[  v => !!v || 'Date of Birth is required']"
               label="D.O.B(*)"
               required
             ></v-text-field>

             <v-textarea
             v-model="address"
              outline
              :rules="[  v => !!v || 'Address is required']"
              name="input-7-4"
              label="Address(*)"
            ></v-textarea>

            <v-layout row wrap>
               <v-flex xs5 md5 offset-md1 offset-xs1>
             <v-text-field
             v-model="telephone"
             type="number"
             label="Telephone"
             ></v-text-field>
           </v-flex>
           <v-flex xs5 md5 offset-md1 offset-xs1>
             <v-text-field
             v-model="phone"
             type="number"
             :rules="[  v => !!v || 'Phone Number is required', v => (v && v.length <= 10) || 'Phone Number must be less than 10 digits']"
             label="Phone Number(*)"
             :counter="10"
             required

             ></v-text-field>
           </v-flex>
         </v-layout>

             <v-text-field
               v-model="email"
               :rules="emailRules"
               label="E-mail"

             ></v-text-field>

             <v-text-field
               v-model="adhar"
               label="Adhar Card Number"
               :counter="12"
             ></v-text-field>


             <v-select
               v-model="select"
               :items="type"
               :rules="[v => !!v || 'Employee type is required']"
               label="Employee type(*)"
               required
             ></v-select>

             <v-text-field
               v-model="joined"
               type = "date"
               label="Joined On(*)"
               :rules="[  v => !!v || 'Joining Date is required']"
               required
             ></v-text-field>
             <v-layout row wrap>
            <v-flex xs5 md5 offset-xs1 offset-md1>
             <v-text-field
               v-model="password"
               label="Password(*)"
               type="password"
               :rules="[  v => !!v || 'Password is required']"
               required
             ></v-text-field>
           </v-flex>
           <v-flex xs5 md5  offset-xs1 offset-md1>
             <v-text-field
               v-model="confirmpwd"
               label="Confirm Password(*)"
               type="password"
               :rules="[  v => (!!v && v) === this.password || 'Password do not match']"
               required
             ></v-text-field>
           </v-flex>
         </v-layout>
             <v-btn
               :disabled="!valid"
               color="success"
               @click="validate"
             >
               Add User
             </v-btn>

             <v-btn
               color="error"
               @click="reset"
             >
               Reset Form
             </v-btn>
<!-- 
             <v-btn
               color="warning"
               @click="resetValidation"
             >
               Reset Validation
             </v-btn> -->
           </v-form>
         </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</v-app>

</template>


<script>
export default {
  mounted()
  {

  },
    data: () => ({
      valid: true,
      empid:'',
      firstname:'',
      lastname:'',
      dob:'',
      address:'',
      telephone:'',
      phone:'',
      email:'',
      adhar:'',
      select:'',
      joined:'',
      password:'',
      confirmpwd:'',
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 30) || 'Name must be less than 30 characters'
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
      select: null,
      type: [
        'Staff',
        'Mechanic',
        'Admin'
      ],
    }),

    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
            axios.post('/employee', {
            employee_id:this.empid,
            first_name: this.firstname,
            last_name:this.lastname,
            dob:this.dob,
            address:this.address,
            telephone:this.telephone,
            phone_no:this.phone,
            email:this.email,
            adhar:this.adhar,
            type:this.select,
            joined_on:this.joined,
            password:this.password,
          })
              .then(response => {
                this.$refs.form.reset()
              })
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      // resetValidation () {
      //   this.$refs.form.resetValidation()
      // }
    }
  }
</script>

<style >

</style>
