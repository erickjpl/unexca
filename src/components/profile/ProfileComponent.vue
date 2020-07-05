<template>
  <ValidationObserver ref="observer" v-slot="{ passes }">
    <q-form @submit="passes(sendForm)" @reset="onReset" class="row">
      <ValidationProvider rules="required" name="name" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-input square filled
          v-model.trim="form.name"
          autofocus
          :label="$t('field.name')"
          :error="invalid && validated"
          :error-message="errors[0]"
        >
          <template v-slot:prepend>
            <q-icon name="edit" />
          </template>
        </q-input>
      </ValidationProvider>

      <ValidationProvider rules="required" name="lastname" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-input square filled
          v-model.trim="form.lastname"
          :label="$t('field.lastname')"
          :error="invalid && validated"
          :error-message="errors[0]"
        >
          <template v-slot:prepend>
            <q-icon name="edit" />
          </template>
        </q-input>
      </ValidationProvider>

      <ValidationProvider rules="" name="dni" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-input square filled fill-mask
          v-model.trim="form.dni"
          mask="A - ##.###.###"
          :hint="$t('form.profile.title.dni')"
          :label="$t('field.dni')"
          :error="invalid && validated"
          :error-message="errors[0]"
        >
          <template v-slot:prepend>
            <q-icon name="edit" />
          </template>
        </q-input>
      </ValidationProvider>

      <ValidationProvider rules="" name="birthdate" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-input square filled fill-mask
          v-model.trim="form.birthdate"
          mask="##/##/####"
          :label="$t('field.birthdate')"
          :error="invalid && validated"
          :error-message="errors[0]"
        >
          <template v-slot:prepend>
            <q-icon name="event" class="cursor-pointer">
              <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
                <q-date v-model="form.birthdate" @input="() => $refs.qDateProxy.hide()" mask="DD/MM/YYYY" />
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
      </ValidationProvider>

      <ValidationProvider rules="required" name="phone" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-option-group class="row"
          v-model="form.genre"
          :options="genres"
          :error="invalid && validated"
          :error-message="errors[0]"
        />
      </ValidationProvider>

      <ValidationProvider rules="" name="phone" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-input square filled fill-mask prefix="+"
          v-model.trim="form.phone"
          mask="## (###) ###-##-##"
          :label="$t('field.phone')"
          :error="invalid && validated"
          :error-message="errors[0]"
          @keyup.enter="formRegister"
        >
          <template v-slot:prepend>
            <q-icon name="edit" />
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
    name: 'ProfileComponent',
    components: {
      ValidationProvider,
      ValidationObserver
    },
    data () {
      return {
        form: {},
        genres: [
          { label: this.$t('form.profile.title.male'), value: 'male' },
          { label: this.$t('form.profile.title.female'), value: 'female' }
        ],
        loading: false
      }
    },
    computed: {
      ...mapGetters('auth', ['user']),
      ...mapGetters('profile', ['profile'])
    },
    created() {
      this.form = {
        dni: this.profile.detail.dni,
        name: this.profile.detail.name,
        phone: this.profile.detail.phone,
        genre: this.profile.detail.genre,
        address: this.profile.detail.address,
        lastname: this.profile.detail.lastname,
        birthdate: this.profile.detail.birthdate,
      }
    },
    methods: {
      ...mapActions('profile', ['updateDetail']),
      sendForm() {
        this.loading = true

        this.updateDetail({id:this.user.id, q:this.form})
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