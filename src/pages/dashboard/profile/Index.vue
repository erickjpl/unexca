<template>
  <span>
    <q-banner class="bg-grey-2">
      <template v-slot:avatar>
        <q-avatar size="120px" class="q-ma-lg">
          <img :src="profile.image.path">
        </q-avatar>
      </template>
      <h4 class="text-h4 q-mb-xs">@{{ user.nickname }}</h4>
      <p class="text-subtitle2">{{ user.email }}</p>
    </q-banner>

    <q-splitter
      v-model="splitterModel"
      style="height: 250px"
      class="row"
    >
      <template v-slot:before>
        <q-tabs
          v-model="tab"
          active-color="primary"
          indicator-color="primary"
          vertical
        >
          <template v-for="item in tabs">
            <q-tab :name="item.name" :icon="item.icon" :label="$t(item.label)" v-if="item.isVisible" />
          </template>
        </q-tabs>
      </template>

      <template v-slot:after>
        <q-tab-panels
          v-model="tab"
          animated
          swipeable
          transition-prev="jump-up"
          transition-next="jump-up"
        >
          <q-tab-panel :name="tab.name" v-for="(tab, index) in tabs" :key="index">
            <q-list bordered padding>
              <show-component :info="user" v-if="tab.name === 'user' && !tab.edit && !changePass" />

              <template v-for="(item, x) in profile" v-if="tab.name == x && !tab.edit">
                <show-component :info="item" />
              </template>

              <q-page-sticky position="bottom-right" :offset="[18, 18]" style="z-index: 1" v-if="!tab.edit && tab.name != 'student' && !changePass">
                <q-fab icon="add" direction="up" color="accent" v-if="tab.name === 'user'">
                  <q-fab-action @click="changePass = true" color="primary" icon="fingerprint" />
                  <q-fab-action @click="tab.edit = true" color="primary" icon="person_pin" />
                </q-fab>

                <q-btn v-else fab icon="edit" color="accent" @click="tab.edit = true" />
              </q-page-sticky>

              <password-component v-if="tab.name == 'user'    && changePass"        @edit="changePass = $event" />
              <account-component  v-if="tab.name == 'user'    && tabs.user.edit"    @edit="tabs.user.edit = $event" />
              <profile-component  v-if="tab.name == 'detail'  && tabs.detail.edit"  @edit="tabs.detail.edit = $event" />
            </q-list>  
          </q-tab-panel>
        </q-tab-panels>
      </template>
    </q-splitter>
  </span>
</template>

<script>
  import { mapGetters }    from 'vuex'
  import ShowComponent     from 'components/profile/ShowComponent'
  import AccountComponent  from 'components/profile/AccountComponent'
  import ProfileComponent  from 'components/profile/ProfileComponent'
  import PasswordComponent from 'components/profile/PasswordComponent'

  export default {
    name: 'DahboardIndex',
    components: {
      ShowComponent,
      AccountComponent,
      ProfileComponent,
      PasswordComponent,
    },
    data () {
      return {
        changePass: false,
        tab: 'user',
        tabs: {
          user:   {name:'user',    icon:'account_circle',    label:'splitter.profile.user',    isVisible:true,  edit:false},
          detail: {name:'detail',  icon:'account_circle',    label:'splitter.profile.detail',  isVisible:false, edit:false},
          teacher:{name:'teacher', icon:'psychology',        label:'splitter.profile.teacher', isVisible:false, edit:false},
          parent: {name:'parent',  icon:'escalator_warning', label:'splitter.profile.parent',  isVisible:false, edit:false},
          student:{name:'student', icon:'face',              label:'splitter.profile.student', isVisible:false, edit:false}
        },
        splitterModel: 27
      }
    },
    computed: {
      ...mapGetters('auth', ['user']),
      ...mapGetters('profile', ['profile'])
    },
    created() {
      Object.keys(this.tabs).forEach(obj => {
          if (this.profile.hasOwnProperty(obj))
           this.tabs[obj].isVisible = true
      })
    },
    methods: {
      onClick () {
        // console.log('Clicked on a fab action')
      }
    }
  }
</script>