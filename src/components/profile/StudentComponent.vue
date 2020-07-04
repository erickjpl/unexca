<template>
  <ValidationObserver ref="observer" v-slot="{ passes }">
    <!-- <q-form @submit="passes(formLogin)" @reset="onReset" class="row">
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

      <ValidationProvider rules="" name="phone" v-slot="{ errors, invalid, validated }" class="col-6 q-pa-xs">
        <q-input square filled fill-mask prefix="+"
          v-model.trim="form.phone"
          mask="## (###) ###-##-##"
          :label="$t('field.phone')"
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

      <q-btn-group spread class="col-12">
        <q-btn color="info" :label="$t('button.cancel')" icon="keyboard_backspace" />
        <q-btn color="accent" :label="$t('button.save')" icon="save" />
      </q-btn-group>
    </q-form> -->
    <h1>Student / Estudiante</h1>
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
        genres: [
          { label: this.$t('form.profile.title.male'), value: 'male' },
          { label: this.$t('form.profile.title.female'), value: 'female' }
        ],
        form: {
          name: '',
          lastname: '',
          dni: '',
          phone: '',
          birthdate: '',
          address: '',
          genre: '',
          email: 'rosa56@example.org',
          password: 'password',
          rememberMe: false
        }
      }
    },
    computed: {
      ...mapGetters('auth', ['user']),
      ...mapGetters('profile', ['profile'])
    },
    created() {

    },
    methods: {
      ...mapActions('auth', ['login']),
      formLogin () {
        
      },
      onReset() {
        requestAnimationFrame(() => this.$refs.observer.reset())
      }
    }
  }
</script>