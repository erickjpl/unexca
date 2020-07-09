<template>
  <q-page class="flex flex-center">
    <p> Welcome {{ this.user.email }} </p>

    <p v-for="n in 15" :key="n">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit nihil praesentium molestias a adipisci, dolore vitae odit, quidem consequatur optio voluptates asperiores pariatur eos numquam rerum delectus commodi perferendis voluptate?
    </p>
  </q-page>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    name: 'DahboardIndex',
    computed: {
      ...mapGetters('auth', ['user'])
    }
  }
</script>
