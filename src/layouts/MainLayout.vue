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
          <a tabindex="0" type="button" href="/" role="link" class="q-btn q-btn-item non-selectable no-outline quasar-logo text-bold q-btn--flat q-btn--rectangle q-btn--actionable q-focusable q-hoverable q-btn--no-uppercase no-border-radius self-stretch q-btn--active"><span class="q-focus-helper"></span><span class="q-btn__wrapper col row q-anchor--skip"><span class="q-btn__content text-center col items-center q-anchor--skip justify-center row no-wrap text-no-wrap"><div class="q-avatar doc-layout-avatar"><div class="q-avatar__content row flex-center overflow-hidden"><img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg"></div></div><div class="q-toolbar__title ellipsis col-shrink">Quasar</div></span></span></a>
        </q-toolbar-title>

        <q-toolbar-title>
          <q-select
            v-model="lang"
            :options="languages"
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
import { mapGetters, mapMutations } from 'vuex'

export default {
  name: 'MainLayout',
  components: {
    EssentialLink
  },
  data () {
    return {
      lang: '',
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
  created() {
    this.lang = this.currentLanguage
  },
  computed: {
    ...mapGetters(['currentLanguage', 'languages'])
  },
  watch: {
    lang(lang) {
      this.$i18n.locale = lang
      // import(`quasar/lang/${lang}`).then(language => { this.$q.lang.set(language.default) })
      import(`quasar/lang/${lang}`).then(({ default: messages }) => { this.$q.lang.set(messages) })
      this.SET_LANGUAGE(lang)
    },
    /* Otra forma
    setLocale (locale) {
      import(`quasar/lang/${locale}`).then(({ default: messages }) => { this.$q.lang.set(messages) })

      import(`src/i18n/${locale}`).then(({ default: messages}) => {
        this.$i18n.locale = locale
        this.$i18n.setLocaleMessage(locale, messages)
      })
    }
    */
  },
  methods: {
    ...mapMutations(['SET_LANGUAGE'])  
  }
}
</script>
