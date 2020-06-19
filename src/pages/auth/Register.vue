<template>
  <div class="q-pa-md row">
    <q-card class="my-card">
      <q-card-section horizontal>
        <q-img
          class="col-5"
          src="https://cdn.quasar.dev/img/parallax1.jpg"
        />

        <q-card-section class="col-7">
        	<q-form
			      @submit="onSubmit"
			      @reset="onReset"
			    >
			      <q-input
			        filled
			        v-model="name"
			        placeholder="Your name *"
			        lazy-rules
			        :rules="[ val => val && val.length > 0 || 'Please type something']"
			      />

			      <q-input
			        filled
			        type="number"
			        v-model="age"
			        placeholder="Your age *"
			        lazy-rules
			        :rules="[
			          val => val !== null && val !== '' || 'Please type your age',
			          val => val > 0 && val < 100 || 'Please type a real age'
			        ]"
			      />

		      	<q-toggle v-model="accept" label="I accept the license and terms" />

      			<q-separator class="q-my-md" />

			      <div>
			        <q-btn flat label="Submit" type="submit" color="primary" />
			        <q-btn flat label="Reset" type="reset" color="secondary" class="q-ml-sm" />
			      </div>
			    </q-form>
        </q-card-section>
      </q-card-section>
    </q-card>
  </div>
</template>

<script>
export default {
  name: 'RegisterPage',
  data () {
    return {
    	name: null,
      age: null,
      accept: false,
      lorem: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    }
  },
  methods: {
    onSubmit () {
      if (this.accept !== true) {
        this.$q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: 'You need to accept the license and terms first'
        })
      } else {
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Submitted'
        })
      }
    },
    onReset () {
      this.name = null
      this.age = null
      this.accept = false
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 800px
</style>
