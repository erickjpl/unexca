<template>
  <q-item
    clickable
    exact
    :to="{ name: link }"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ $t(title) }}</q-item-label>
      <q-item-label caption>
        {{ $t(caption) }}
      </q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
export default {
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      type: String,
      default: 'javascript:void(0)'
    },

    icon: {
      type: String,
      default: ''
    }
  }
}
</script>
