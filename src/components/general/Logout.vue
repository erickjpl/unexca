<template>
  <div />
</template>

<script>
  import { mapActions } from 'vuex'

  export default {
    name: 'Logout',
    mounted () {
      this.$q.dialog({
        title: this.$i18n.t('dialog.logout.title'),
        message: this.$i18n.t('dialog.logout.message'),
        ok: this.$i18n.t('button.continue'),
        cancel: this.$i18n.t('button.cancel')
      }).onOk(() => {
        this.logout().then(() => {
          this.$router.push({ name: 'index' })
        }).catch(error => console.log(error))
      }).onCancel(() => {
        this.$router.go(-1)
      })
    },
    methods: {
      ...mapActions('auth', ['logout'])
    }
  }
</script>
