<template>
  <q-layout view="hHh Lpr lff" class="shadow-2 rounded-borders">
    <q-header bordered class="bg-primary text-white" height-hint="98">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
          </q-avatar>
          Title
        </q-toolbar-title>

        <q-btn flat @click="drawer = !drawer" round dense icon="menu" />
      </q-toolbar>

      <q-toolbar inset>
        <q-breadcrumbs>
          <q-breadcrumbs-el icon="home" to="javascrip:void(0)" class="text-white" />
          <q-breadcrumbs-el label="Docs" icon="widgets" to="javascrip:void(0)" class="text-white" />
          <q-breadcrumbs-el label="Breadcrumbs" icon="navigation" to="javascrip:void(0)" class="text-white" />
          <q-breadcrumbs-el label="Build" icon="build" />
        </q-breadcrumbs>
      </q-toolbar>

      <!-- <q-tabs align="center">
        <q-route-tab :to="{ name: 'login' }" label="Login" />
        <q-route-tab :to="{ name: 'register' }" label="Register" />
        <q-route-tab :to="{ name: 'dashboard.index' }" label="Dashboard" />
      </q-tabs> -->
    </q-header>

    <q-drawer
      v-model="drawer"
      show-if-above

      :mini="!drawer || miniState"
      @click.capture="drawerClick"

      :width="200"
      :breakpoint="500"
      bordered
      content-class="bg-grey-3"
    >
      <template v-slot:mini>
        <q-scroll-area class="fit mini-slot cursor-pointer" :bar-style="barStyle">
          <q-list padding>
          <template v-for="(menuItem, index) in menuList">
            <q-item clickable v-ripple :key="index" v-if="check(menuItem.role)">
              <q-icon :name="menuItem.icon" :color="menuItem.color" class="mini-icon" :key="index" />
            </q-item>

            <q-separator v-if="menuItem.separator" />
          </template>
        </q-list>
        </q-scroll-area>
      </template>

      <q-scroll-area class="" :bar-style="barStyle" style="height: calc(100% - 150px); margin-top: 150px; border-right: 1px solid #ddd">
        <q-list padding>
          <template v-for="(menuItem, index) in menuList">
            <q-item clickable exact v-ripple :key="index" v-if="check(menuItem.role)" :to="{ name: menuItem.path }">
              <q-item-section avatar>
                <q-icon :name="menuItem.icon" :color="menuItem.color" />
              </q-item-section>

              <q-item-section>
                {{ $t(menuItem.label) }}
              </q-item-section>
            </q-item>

           <q-separator v-if="menuItem.separator" />
          </template>
        </q-list>
      </q-scroll-area>

      <!--
        in this case, we use a button (can be anything)
        so that user can switch back
        to mini-mode
      -->
      <div class="q-mini-drawer-hide absolute" style="top: 160px; right: -17px">
        <q-btn
          dense
          round
          unelevated
          color="accent"
          icon="chevron_left"
          @click="miniState = true"
        />
      </div>

      <q-img class="absolute-top" src="https://cdn.quasar.dev/img/material.png" style="height: 150px">
        <div class="absolute-bottom bg-transparent">
          <q-avatar size="56px" class="q-mb-sm">
            <img src="https://cdn.quasar.dev/img/boy-avatar.png">
          </q-avatar>
          <div class="text-weight-bold">{{ user.email }}</div>
          <div>@{{ user.nickname }}</div>
        </div>
      </q-img>
    </q-drawer>

    <q-page-container>
      <router-view />

      <q-page-scroller position="bottom-right" :scroll-offset="150" :offset="[18, 18]">
        <q-btn fab icon="keyboard_arrow_up" color="accent" />
      </q-page-scroller>
    </q-page-container>

    <q-footer reveal elevated class="bg-accent text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
          </q-avatar>
          Title
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>
  </q-layout>
</template>

<script>
  import { mapGetters, mapMutations } from 'vuex'

  const menuList = [
    {
      icon: 'inbox',
      color: 'brown',
      label: 'menu.dashboard.home',
      path: 'dashboard.index',
      role: '',
      separator: false
    },
    {
      icon: 'send',
      color: 'blue',
      label: 'menu.dashboard.home',
      path: 'dashboard.admin',
      role: 'admin',
      separator: false
    },
    {
      icon: 'settings',
      color: 'orange',
      label: 'menu.dashboard.home',
      path: 'dashboard.other',
      role: 'superadmin',
      separator: false
    },
    {
      icon: 'account_circle',
      color: 'purple',
      label: 'menu.dashboard.profile',
      path: 'dashboard.profile',
      role: '',
      separator: true
    },
    {
      icon: 'exit_to_app',
      color: 'pink',
      label: 'menu.dashboard.logout',
      path: 'logout',
      role: '',
      separator: false
    }
  ]

  export default {
    name: 'DashboardLayout',
    data () {
      return {
        lang: '',
        drawer: false,
        miniState: true,
        menuList,
        barStyle: {
          right: '2px',
          borderRadius: '9px',
          backgroundColor: '#027be3',
          width: '9px',
          opacity: 0.2
        }
      }
    },
    computed: {
      ...mapGetters('auth', ['user', 'check']),
      ...mapGetters(['currentLanguage', 'languages'])
    },
    watch: {
      lang(lang) {
        this.$i18n.locale = lang
        import(`quasar/lang/${lang}`).then(({ default: messages }) => { this.$q.lang.set(messages) })
        this.SET_LANGUAGE(lang)
      }
    },
    created() {
      this.lang = this.currentLanguage
    },
    methods: {
      ...mapMutations(['SET_LANGUAGE']),
      drawerClick (e) {
        // if in "mini" state and user
        // click on drawer, we switch it to "normal" mode
        if (this.miniState) {
          this.miniState = false

          // notice we have registered an event with capture flag;
          // we need to stop further propagation as this click is
          // intended for switching drawer to "normal" mode only
          e.stopPropagation()
        }
      }
    }
  }
</script>

<style lang="sass" scoped>
.mini-slot
  transition: background-color .28s
  &:hover
    background-color: rgba(0, 0, 0, .04)

.mini-icon
  font-size: 1.718em

  & + &
    margin-top: 18px
</style>