<template>
  <q-page class="bg-light-green window-height window-width row justify-center items-center">
    <div class="column">
      <div class="row justify-center">
        <h5 class="text-h5 text-white q-my-md">UNEXCA</h5>
      </div>

      <div class="row">
        <q-card square bordered class="shadow-1">
          <q-card-section horizontal>
            <q-img
              class="col-5"
              src="https://cdn.quasar.dev/img/parallax1.jpg"
            />

            <q-card-section class="col-7">
              <q-form class="q-gutter-md" @submit="onSubmit" @reset="onReset">
                <q-input square filled clearable v-model="email" type="email" placeholder="email" />
                <q-input square filled clearable v-model="password" type="password" placeholder="password" />
              </q-form>

              <q-toggle v-model="accept" label="I accept the license and terms" />

              <q-separator class="q-my-md" />

              <q-card-actions class="q-px-md">
                <q-btn unelevated color="light-green-7" size="lg" class="full-width" label="Login" type="submit" />
              </q-card-actions>

              <q-card-section class="text-center q-pa-none">
                <p class="text-grey-6">Not reigistered? Created an Account</p>
              </q-card-section>
            </q-card-section>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'Login',
  data () {
    return {
      email: null,
      password: null,
      accept: false
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

<style>
.q-card {
  width: 600px;
}
</style>