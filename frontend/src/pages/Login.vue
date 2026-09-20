<template>
    <div class="login-page">
        <h1>Login</h1>
        <form @submit.prevent="handleLogin">
            <div>
                <label for="email">
                    Email:
                </label>
                <input
                    type="email"
                    v-model="email"
                >
            </div>
            <div>
                <label for="password">
                    Password:
                </label>
                <input
                    type="password"
                    v-model="password"
                >
            </div>
            <button type="submit">Log In</button>
        </form>
        <p v-if="errorMessage">
            {{ errorMessage }}
        </p>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { login } from '../api/authApi';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    //Reactive values for the form inputs
    const email = ref('');
    const password = ref('');

    //This will eventually hold an error from the API
    const errorMessage = ref('');

    async function handleLogin() {
        //Clear any previous error
        errorMessage.value = '';

        try {
            const response = await login(
                email.value, 
                password.value);
            router.push('/home');
        } catch (error) {
            console.log('Login failed:');
            console.log(error);

            errorMessage.value = 'Login failed.';
        }

        //set email to pop@chop.com
        // email.value = 'pop@chop.com';
    }
</script>