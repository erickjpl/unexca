<template>
  <q-dialog v-model="show" persistent transition-show="scale" transition-hide="scale">
    <q-card class="bg-teal text-white" style="width: 300px">
      <q-card-section>
        <div class="text-h6">Su sesión esta por terminar.</div>
      </q-card-section>

      <q-card-section class="q-pt-none">
        Desea extender su sesión para continuar usando la aplicación
      </q-card-section>

      <q-card-actions align="right" class="bg-white text-teal">
        <div>
          <strong>{{ seg }}</strong> segundos...
        </div>
        <div align="right">
          <q-btn flat label="OK" @click="refresh" />
          <q-btn flat label="Cancel" @click="$emit('update:show', false)" />
        </div>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true
      },
      seg: {
        type: Number,
        required: true
      }
    },
    updated() {
      this.session()
    },
    methods: {
      session() {       
        if (this.seg == 1) {
          this.$emit('isLogout',true)
        }
      },
      refresh() {       
        this.$emit('update:show', false)
        this.$emit('isLogout', false)
      }
    }
  }
</script>