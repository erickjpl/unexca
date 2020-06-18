<template>
  <q-page class="flex flex-center">
    <img
      alt="Quasar logo"
      src="~assets/quasar-logo-full.svg"
    >
  </q-page>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'PageIndex',
  created() {
  	this.getAllUsers()
  },
  computed: {
	  ...mapGetters('profile', ['users'])
  },
  methods: {
    ...mapActions('profile', ['getAllUsers'])
  }
}
</script>
