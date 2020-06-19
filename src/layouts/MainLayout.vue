<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          Quasar App
        </q-toolbar-title>

        <q-toolbar-title>
          <q-select
            v-model="lang"
            :options="langOptions"
            label="Quasar Language"
            dense
            borderless
            emit-value
            map-options
            options-dense
            style="min-width: 150px"
          />
        </q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <q-item-label
          header
          class="text-grey-8"
        >
          UNEXCA
        </q-item-label>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink'
import Quasar from 'quasar'

export default {
  name: 'MainLayout',
  components: {
    EssentialLink
  },
  data () {
    return {
      lang: this.$i18n.locale,
      langOptions: [
        { value: 'en-us', label: 'English' },
        { value: 'es', label: 'Español' }
      ],
      leftDrawerOpen: false,
      essentialLinks: [
        {
          title: 'menu.home',
          caption: 'menu.caption.home',
          icon: 'school',
          link: 'index'
        },
        {
          title: 'menu.about',
          caption: 'menu.caption.about',
          icon: 'school',
          link: 'about'
        },
        {
          title: 'menu.dashboard',
          caption: 'menu.caption.dashboard',
          icon: 'school',
          link: 'dashboard.index'
        },
        {
          title: 'menu.login',
          caption: 'menu.caption.login',
          icon: 'school',
          link: 'login'
        },
        {
          title: 'menu.register',
          caption: 'menu.caption.register',
          icon: 'school',
          link: 'register'
        }
      ]
    }
  },
  watch: {
    lang(lang) {
      this.$i18n.locale = lang
      import(`quasar/lang/${lang}`).then(language => { this.$q.lang.set(language.default) })
    }
  }
}
</script>
