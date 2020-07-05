<template>
  <ValidationObserver ref="observer" v-slot="{ passes }">
    <q-form @submit="passes(sendForm)" @reset="onReset" class="row flex flex-center">
      <ValidationProvider rules="required" name="password" v-slot="{ errors, invalid, validated }" class="col-12 q-pa-xs">
        <q-input square filled
          v-model.trim="form.password"
          type="password"
          :label="$t('field.password')"
          :error="invalid && validated"
          :error-message="errors[0]"
        >
          <template v-slot:prepend>
            <q-icon name="fingerprint" />
          </template>
        </q-input>
      </ValidationProvider>

      <ValidationProvider rules="required|confirmed:password" name="password_confirmation" v-slot="{ errors, invalid, validated }" class="col-12 q-pa-xs">
        <q-input square filled
          v-model.trim="form.password_confirmation"
          type="password"
          @keyup.enter="sendForm"
          :label="$t('field.password_confirmation')"
          :error="invalid && validated"
          :error-message="errors[0]"
        >
          <template v-slot:prepend>
            <q-icon name="fingerprint" />
          </template>
        </q-input>
      </ValidationProvider>

      <q-btn-group spread class="full-width">
        <q-btn color="info" :label="$t('button.cancel')" icon="keyboard_backspace" @click="$emit('edit', false)" />
        <q-btn color="accent" :label="$t('button.save')" icon="save" @click="sendForm" :loading="loading" />
      </q-btn-group>
    </q-form>
  </ValidationObserver>
</template>

<script>
  import { ValidationProvider, ValidationObserver } from "vee-validate"
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'PasswordComponent',
    components: {
      ValidationProvider,
      ValidationObserver
    },
    data () {
      return {
        form: {
          password: '',
          password_confirmation: '',
        },
        loading: false
      }
    },
    computed: {
      ...mapGetters('auth', ['user']),
    },
    created() {

    },
    methods: {
      ...mapActions('auth', ['updateAccount']),
      sendForm() {
        this.loading = true

        this.updateAccount({id:this.user.id, q:this.form})
          .then((response) => {
            this.$emit('edit', false)
          }).catch((error) => {
            if (error.response) {
              if (error.response.status === 401) {
                this.$q.dialog({
                  message: this.$t('message.error.error_401')
                })
              } else if (error.response.status === 403) {
                this.$q.dialog({
                  message: this.$t('message.error.error_403')
                })
              } else if (error.response.status === 422) {
                // errores laravel recorrer y pintar en input
              } else {
                console.error(error)
              }
            }
          }).finally(() => {
            this.loading = false
          })
      },
      onReset() {
        requestAnimationFrame(() => this.$refs.observer.reset())
      }
    }
  }
</script>