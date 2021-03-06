<template>
  <q-page class="bg-primary window-height window-width flex flex-center row justify-center items-center">
    <q-card class="bg-grey-2 col-12"
      square
      style="max-width: 650px"
    >
      <ValidationObserver ref="observer" v-slot="{ passes }">
        <q-form @submit="passes(formRegister)" @reset="onReset">
          <q-card-section horizontal>
            <q-img
              class="col-5 row"
              src="https://cdn.quasar.dev/img/parallax1.jpg"
            />

            <q-card-section class="col-7">
              <div class="text-h6 text-center q-mb-md">
                {{ $t('card.register.title') }}
              </div>

              <ValidationProvider rules="required" name="nickname" v-slot="{ errors, invalid, validated }">
                <q-input class="q-my-sm" standout="bg-accent text-white"
                  v-model.trim="form.nickname"
                  autofocus
                  :hint="$t('field.hint.nickname')"
                  :label="$t('field.nickname')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                />
              </ValidationProvider>

              <ValidationProvider rules="required" name="email" v-slot="{ errors, invalid, validated }">
                <q-input class="q-my-sm" standout="bg-accent text-white"
                  v-model.trim="form.email"
                  type="email"
                  :hint="$t('field.hint.email')"
                  :label="$t('field.email')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                />
              </ValidationProvider>

              <ValidationProvider rules="required" name="password" v-slot="{ errors, invalid, validated }">
                <q-input class="q-my-sm" standout="bg-accent text-white"
                  v-model.trim="form.password"
                  type="password"
                  :hint="$t('field.hint.password')"
                  :label="$t('field.password')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
                />
              </ValidationProvider>

              <ValidationProvider rules="required" name="password_confirmation" v-slot="{ errors, invalid, validated }">
                <q-input class="q-my-sm" standout="bg-accent text-white"
                  v-model.trim="form.password_confirmation"
                  type="password"
                  @keyup.enter="formRegister"
                  :hint="$t('field.hint.password_confirmation')"
                  :label="$t('field.password_confirmation')"
                  :error="invalid && validated"
                  :error-message="errors[0]"
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
                  {{ $t('button.register') }}
                </q-btn>
              </q-card-actions>

              <q-card-section class="text-center q-pa-none">
                <p class="text-info">
                  {{ $t('card.register.reigistered') }} 
                  <router-link :to="{ name: 'login' }" class="q-link text-accent">{{ $t('link.created_account') }}</router-link>
                </p>
              </q-card-section>

              <q-card-section class="text-center q-pa-none">
                <router-link :to="{ name: 'password.forgot' }" class="q-link text-accent">
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
  name: 'Register',
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data () {
    return {
      form: {
        email: '@mail.com',
        nickname: '',
        password: 'password',
        password_confirmation: 'password',
        rememberMe: false
      },
      loading: false
    }
  },
  meta() {
    return {
      // sets document title 
      title: this.$t('meta.register.title'),
      // optional; sets final title as "Index Page - My Website", useful for multiple level meta
      titleTemplate: title => `STA - ${title}`,

      // meta tags
      meta: {
        description: { name: 'description', content: this.$t('meta.register.tag.description') },
        keywords: { name: 'keywords', content: 'Quasar website' },
        equiv: { 'http-equiv': 'Content-Type', content: 'text/html; charset=UTF-8' }
      }
    }
  },
  methods: {
    ...mapActions('auth', ['register']),
    formRegister () {
      this.loading = true

      this.register(this.form)
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
            this.$q.dialog({ message: error.response })
          } else {
            this.$q.dialog({ message: error.response })
          }
          this.$q.dialog({ message: error.response })
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