<template>
    <div class="character-list">
        <h2>My Characters</h2>

        <p v-if="characters.length === 0">
            You don't have any characters yet.
        </p>

        <div v-else class="character-list-box">
            <router-link
                v-for="character in characters"
                :key="character.id"
                :to="`/characters/${character.id}`"
                class="character-item"
            >
            {{ character.name }} 
            - {{ character.race?.name }} 
            {{ classNames(character) }}
            </router-link>
        </div>
    </div>
</template>

<script setup>

    defineProps({
        characters: {
            type: Array,
            required: true
        }
    })

    function classNames(character) {
        return character.classes
            .map((characterClass) => characterClass.class_definition?.name)
            .filter(Boolean)
            .join(' / ');
    }

</script>

<style scoped>
    .character-item {
        display:block;
        padding: 8px;
    }
</style>