<template>
  <q-page
    v-cloak
    padding
  >
    <p>aaa
      {{ message }}
    </p>
  </q-page>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'Verification',
    data () {
      return {
        message: null,
        loading: false
      }
    },
    computed: {
      ...mapGetters('auth', ['user'])
    },
    mounted () {
      this.verifyUser()
    },
    methods: {
      ...mapActions('auth', ['verify', 'logout']),
      verifyUser () {
        this.loading = true

        if(!! this.$route.params.id && !! this.$route.query.expires && !! this.$route.query.signature) {
          if(this.$route.params.id == this.user.id) {
            let verifyEmail = {
              id: this.$route.params.id,
              hash: this.$route.params.hash,
              expires: this.$route.query.expires,
              signature: this.$route.query.signature
            }
            
            this.verify(verifyEmail)
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
          } else {
            this.$router.push({ name: 'dashboard.index' })
          }
        } else {
          this.$router.push({ name: 'dashboard.index' })
        }
      }
    }
  }
</script>

<style>
[v-cloak] {
  display: none;
}
</style>
