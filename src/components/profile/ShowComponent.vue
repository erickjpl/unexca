<template>
  <span>
    <template v-for="(item, index) in info" v-if="index != 'id' && index != 'name' && index != 'lastname'">
      <q-item>
        <q-item-section avatar>
          <q-icon color="primary" :name="item != '' ? 'verified' : 'new_releases'" />
        </q-item-section>
        <q-item-section>{{ $t(`field.${index}`) }}</q-item-section>
        <q-item-section><q-item-label caption>{{ item }}</q-item-label></q-item-section>
      </q-item>

      <q-separator spaced inset="item" />
    </template>
  </span>
</template>

<script>
  export default {
    name: 'ShowComponent',
    props: {
      info: {
        type: Object,
        required: true
      }
    }
  }
</script>