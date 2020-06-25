<template>
  <q-page class="flex flex-center">
    <ValidationObserver ref="observer" v-slot="{ passes }">
      <q-form @submit="passes(onSubmit)" @reset="onReset" class="q-gutter-md">
        <ValidationProvider rules="required|email" v-slot="{ errors, invalid, validated }" name="email">
          <q-input
            filled
            v-model="email"
            type="email"
            label="Your email *"
            hint="Email address"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          name="password"
          rules="required|confirmed:confirmation"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            filled
            v-model="password"
            type="password"
            label="Your Password"
            hint="Enter a strong password"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          name="confirmation"
          rules="required"
          v-slot="{ errors, invalid, validated }"
        >
          <q-input
            filled
            v-model="confirmation"
            type="password"
            label="Password Confirmation"
            hint="Confirm your passsword"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider rules="required" name="subject" v-slot="{ errors, invalid, validated }">
          <q-select
            filled
            v-model="subject"
            :options="options"
            label="Filled"
            :error="invalid && validated"
            :error-message="errors[0]"
          />
        </ValidationProvider>

        <ValidationProvider
          rules="required|length:2"
          name="drinks"
          v-slot="{ errors, invalid, validated }"
        >
          <q-field :error="invalid && validated" :error-message="errors[0]" borderless>
            <q-checkbox v-model="choices" label="Coffee" val="coffee" />
            <q-checkbox v-model="choices" label="Tea" val="tea" />
            <q-checkbox v-model="choices" label="Soda" val="soda" />
          </q-field>
        </ValidationProvider>

        <div>
          <q-btn label="Submit" type="submit" color="primary" />
          <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
        </div>
      </q-form>
    </ValidationObserver>
  </q-page>
</template>

<style>
</style>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";

export default {
  name: "AppForm",
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data: () => ({
    email: "",
    password: "",
    confirmation: "",
    subject: "",
    choices: [],
    options: ["", "Subject 1", "Subject 2"]
  }),
  methods: {
    onSubmit() {
      // eslint-disable-next-line
      console.log("Form submitted yay!");
    },
    onReset() {
      this.email = "";
      this.password = "";
      this.confirmation = "";
      this.subject = "";
      this.choices = [];
      requestAnimationFrame(() => {
        this.$refs.observer.reset();
      });
    }
  }
};
</script>