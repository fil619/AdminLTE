<template>
<v-app>
  <div style="padding-top:10px">
 <div class="headline font-weight-black" style="color:#B71C1C">
 <i class="fas fa-user-plus" ></i> Add Employee
</div>
  <v-divider></v-divider>
  <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-container fluid>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="firstname"
            :rules="nameRules"
            label="First Name(*)"
            :counter="30"
            required
          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="lastname"
            :rules="nameRules"
            label="Last Name(*)"
            :counter="30"
            required
          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="dob"
            type = "date"
            :rules="[  v => !!v || 'Date of Birth is required']"
            label="D.O.B(*)"
            required
          ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md3
          >
          <v-text-field
          v-model="telephone"
          type="number"
          label="Telephone"
          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
          v-model="phone"
          type="number"
          :rules="[  v => !!v || 'Phone Number is required', v => (v && v.length <= 10) || 'Phone Number must be less than 10 digits']"
          label="Phone Number(*)"
          :counter="10"
          required

          ></v-text-field>
          </v-flex>

          <v-flex
            xs12
            md3
          >
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
             ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md9
          >
            <v-text-field
              v-model="address"
              :counter="10"
              label="Address"
              :rules="[  v => !!v || 'Address is required']"
              required
            ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md9
          >
          <v-text-field
            v-model="adhar"
            label="Adhar Card Number"
            mask="NNNN-NNNN-NNNN"
            :counter="12"
          ></v-text-field>
          </v-flex>
          <v-flex
            xs12
            md9
          >
          <v-select
            v-model="select"
            :items="type"
            :rules="[v => !!v || 'Employee type is required']"
            label="Employee type(*)"
            required
          ></v-select>
          </v-flex>
          <v-flex
            xs12
            md9
          >
          <v-text-field
            v-model="joined"
            type = "date"
            label="Joined On(*)"
            :rules="[  v => !!v || 'Joining Date is required']"
            required
          ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout justify-center row wrap>
          <v-flex
            xs12
            md5
          >
          <v-text-field
            v-model="password"
            label="Password(*)"
            type="password"
            :rules="[  v => !!v || 'Password is required']"
            required
          ></v-text-field>
          </v-flex>
          <v-flex
            xs12
            md5
          >
          <v-text-field
            v-model="confirmpwd"
            label="Confirm Password(*)"
            type="password"
            :rules="[  v => (!!v && v) === this.password || 'Password do not match']"
            required
          ></v-text-field>
          </v-flex>
        </v-layout>
        <v-layout  row wrap justify-center>
        <v-flex xs12 sm6 md9 class="text-xs-center">
              <v-btn
                color="success"
                @click="validate"
              >
                Generate
              </v-btn>
              <v-btn
              color="error"
              @click="reset"
              >
              Reset Form
            </v-btn>
        </v-flex>

      </v-layout>
      </v-container>
    </v-form>

</div>
</v-app>
</template>

<script>
export default {
  mounted()
  {

  },
    data: () => ({
      valid: true,
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
            status:'Not Available',
          })
              .then(response => {
                this.$refs.form.reset()
              })
        }
      },
      reset () {
        this.$refs.form.reset()
      },
    }
  }
</script>

<style >

</style>
