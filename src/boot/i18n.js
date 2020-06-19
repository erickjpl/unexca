import Vue from 'vue'
import VueI18n from 'vue-i18n'
import { messages, numberFormats } from 'src/i18n'
import { Quasar } from 'quasar'

Vue.use(VueI18n)

const defaultLocale = Quasar.lang.isoName

const i18n = new VueI18n({
  locale: defaultLocale,
  fallbackLocale: defaultLocale,
  messages,
  numberFormats
})

export default ({ app }) => {
  // Set i18n instance on app
  app.i18n = i18n
}

export { i18n }
