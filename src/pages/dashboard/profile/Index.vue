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
          vertical
        >
          <q-tab :name="tabs.detail.name" :icon="tabs.detail.icon" :label="$t(tabs.detail.label)" v-if="tabs.detail.isVisible" />
          <q-tab :name="tabs.teacher.name" :icon="tabs.teacher.icon" :label="$t(tabs.teacher.label)" v-if="tabs.teacher.isVisible" />
          <q-tab :name="tabs.parent.name" :icon="tabs.parent.icon" :label="$t(tabs.parent.label)" v-if="tabs.parent.isVisible" />
          <q-tab :name="tabs.student.name" :icon="tabs.student.icon" :label="$t(tabs.student.label)" v-if="tabs.student.isVisible" />
        </q-tabs>
      </template>

      <template v-slot:after>
        <q-tab-panels
          v-model="tab"
          animated
          swipeable
          vertical
          transition-prev="jump-up"
          transition-next="jump-up"
        >
          <q-tab-panel :name="tabs.detail.name">
            <q-list bordered padding>
              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="verified" />
                </q-item-section>
                <q-item-section>Name</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.detail.lastname }}, {{ profile.detail.name }}</q-item-label>
                </q-item-section>
              </q-item>

              <q-separator spaced inset="item" />

              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="new_releases" />
                </q-item-section>
                <q-item-section>DNI</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.detail.dni }}</q-item-label>
                </q-item-section>
              </q-item>

              <q-separator spaced inset="item" />

              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="new_releases" />
                </q-item-section>
                <q-item-section>Phone</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.detail.phone }}</q-item-label>
                </q-item-section>
              </q-item>

              <q-separator spaced inset="item" />

              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="new_releases" />
                </q-item-section>
                <q-item-section>Birthdate</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.detail.birthdate }}</q-item-label>
                </q-item-section>
              </q-item>

              <q-separator spaced inset="item" />

              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="new_releases" />
                </q-item-section>
                <q-item-section>Genre</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.detail.genre }}</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>

            <profile-component v-if="tab.name == 'profile'" />
          </q-tab-panel>

          <q-tab-panel :name="tabs.student.name">
            <q-list bordered padding>
              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="verified" />
                </q-item-section>
                <q-item-section>Type</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.student.type }}</q-item-label>
                </q-item-section>
              </q-item>

              <q-separator spaced inset="item" />

              <q-item>
                <q-item-section avatar>
                  <q-icon color="primary" name="new_releases" />
                </q-item-section>
                <q-item-section>Status</q-item-section>
                <q-item-section>
                  <q-item-label caption>{{ profile.student.status }}</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>

            <student-component v-if="tab.name == 'student'" />
          </q-tab-panel>
        </q-tab-panels>
      </template>
    </q-splitter>
  </span>
</template>

<script>
  import { mapGetters } from 'vuex'
  import ProfileComponent from 'components/profile/ProfileComponent'
  import StudentComponent from 'components/profile/StudentComponent'

  export default {
    name: 'DahboardIndex',
    components: {
      ProfileComponent,
      StudentComponent
    },
    data () {
      return {
        tab: 'profile',
        tabs: {
          detail:  { name: 'profile', icon: 'account_circle',    label: 'splitter.profile.profile', isVisible: false },
          teacher: { name: 'teacher', icon: 'psychology',        label: 'splitter.profile.teacher', isVisible: false },
          parent:  { name: 'parent',  icon: 'escalator_warning', label: 'splitter.profile.parent',  isVisible: false },
          student: { name: 'student', icon: 'face',              label: 'splitter.profile.student', isVisible: false }
        },
        splitterModel: 25
      }
    },
    computed: {
      ...mapGetters('auth', ['user']),
      ...mapGetters('profile', ['profile'])
    },
    created() {
      Object.keys(this.tabs).forEach(obj => {
          this.tabs[obj].isVisible = this.profile.hasOwnProperty(obj) ? true : false
      })
    }
  }
</script>