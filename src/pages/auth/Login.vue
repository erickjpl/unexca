<template>
  <q-page class="bg-primary window-height window-width flex flex-center row justify-center items-center">
    <q-card class="bg-dark text-white col-12"
      square
      style="max-width: 650px"
    >
      <ValidationObserver ref="observer" v-slot="{ passes }">
        <q-form @submit="passes(formLogin)" @reset="onReset">
          <q-card-section horizontal>
            <q-img
              class="col-5 row"
              src="https://cdn.quasar.dev/img/parallax1.jpg"
            />

            <q-card-section class="col-7">
              <div class="text-h6 text-center q-mb-md">
                {{ $t('card.login.title') }}
              </div>

              <ValidationProvider rules="required" name="email" v-slot="{ errors, invalid, validated }">
                <q-input class="q-my-sm"
                  id="email"
                  color="lime"
                  filled
                  v-model.trim="form.email"
                  type="email"
                  autofocus
                  :hint="$t('field.hint.email')"
                  :label="$t('field.email')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                />
              </ValidationProvider>

              <ValidationProvider rules="required" name="password" v-slot="{ errors, invalid, validated }">
                <q-input class="q-my-sm"
                  id="password"
                  color="lime"
                  filled
                  v-model.trim="form.password"
                  type="password"
                  @keyup.enter="formLogin"
                  :hint="$t('field.hint.password')"
                  :label="$t('field.password')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                />
              </ValidationProvider>

              <ValidationProvider rules="" name="rememberMe" v-slot="{ errors, invalid, validated }">
                <q-checkbox class="text-center"
                  id="rememberMe"
                  v-model="form.rememberMe"
                  :label="$t('field.remember_me')"
                />
              </ValidationProvider>

              <q-separator class="q-my-md" />

              <q-card-actions>
                <q-btn class="full-width"
                  unelevated
                  color="primary"
                  :loading="loading"
                  type="submit"

                >
                  {{ $t('button.login') }}
                </q-btn>
              </q-card-actions>

              <q-card-section class="text-center q-pa-none">
                <p class="text-grey-6">
                  {{ $t('card.login.not_reigistered') }} 
                  <router-link :to="{ name: 'password.forgot' }">{{ $t('link.created_account') }}</router-link>
                </p>
              </q-card-section>

              <q-card-section class="text-center q-pa-none">
                <router-link :to="{ name: 'password.forgot' }">
                  {{ $t('link.password_forgot') }}
                </router-link>
              </q-card-section>
            </q-card-section>
          </q-card-section>
        </q-form>
      </ValidationObserver>
    </q-card>
  </q-page>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { mapActions } from 'vuex'

export default {
  name: 'Login',
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data () {
    return {
      form: {
        email: 'rosa56@example.org',
        password: 'password',
        rememberMe: false
      },
      loading: false
    }
  },
  methods: {
    ...mapActions('auth', ['login']),
    formLogin () {
      this.loading = true

      this.login(this.form)
      .then((response) => {
        this.$router.push({ name: 'dashboard.index' })
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
      requestAnimationFrame(() => {
        this.$refs.observer.reset();
      });
    }
  }
}
</script>