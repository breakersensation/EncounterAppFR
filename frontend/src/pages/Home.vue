<template>
    <div class="home-page">
        <h1>Welcome to D&D Page</h1>

        <p>Character Manager</p>

        <button @click="handleLogout">
            Logout
        </button>

        <div>
            <router-link to="/login">
                Log In
            </router-link>
        </div>

        <p v-if="loading">
            Loading characters...
        </p>

        <p v-else-if="errorMessage">
            {{  errorMessage }}
        </p>

        <CharacterList 
            v-else
            :characters="characters"
        />

        <!-- <div>
            <router-link to="/characters/13">
                Character Sheet Example #13
            </router-link>
        </div> -->
        
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue';
    import { useRouter } from 'vue-router';
    import CharacterList from '../components/CharacterList.vue';
    import {logout} from '../api/authApi.js';
    import { getCharacterList } from '../api/characterApi.js';

    const router = useRouter();

    //Home owns the character data.
    const characters = ref([]);
    const loading = ref(true);
    const errorMessage = ref('');

    async function loadCharacters() {
        try {
            characters.value = await getCharacterList();
            console.log('Characters loaded:', characters.value);
        } catch (error) {
            errorMessage.value = 'Unable to load characters.';
            console.log('Error fetching characters:', error);
        } finally {
            loading.value = false;
        }
    }

    onMounted(() => {
        loadCharacters();
    });

    async function handleLogout() {
        await logout();

        router.push('/login');
    }
</script>
<style scoped>
    /* .home-page {
        text-align: center;
    } */

    .character-list-box {
        max-height: 250px;
        overflow-y: auto;
    }

    .character-item {
        display:block;
        padding: 8px;
    }
</style>