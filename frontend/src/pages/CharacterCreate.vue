<template>
  <form @submit.prevent="saveCharacter">
    <div>
      <h1>Create Character</h1>

      <label for="name">Name: </label>
      <input
        id="name"
        v-model="characterTraits.name"
        placeholder="Character Name"
      />

      <p>Name: {{ characterTraits.name }}</p>
    </div>

    <div>
      <label for="species">Species: </label>
      <select v-model="characterTraits.singularSpeciesId">
        <option value="">Select Species</option>

        <option
          v-for="singularSpecies in species"
          :key="singularSpecies.id"
          :value="singularSpecies.id"
        >
          {{ singularSpecies.name }}
        </option>
      </select>
    </div>

    <div>
      <label for="class">Class: </label>
      <select v-model="characterTraits.singularClassId">
        <option value="">Select Class</option>

        <option
          v-for="singularClass in classes"
          :key="singularClass.id"
          :value="singularClass.id"
          >
          {{  singularClass.name }}
          </option>
      </select>
    </div>

    <div>
      <label for="background">Background: </label>
      <select v-model="characterTraits.backgroundId">
        <option value="">Select Background</option>
      
        <option
          v-for="background in backgrounds"
          :key="background.id"
          :value="background.id"
          >
        {{ background.name }}
        </option>
      </select>
    </div>

    <br/>

    <div>
      <div>Ability Scores:</div>
      <AbilityScore
        v-for="ability in abilities"
        :key="ability.key"
        :abilityLabel="ability.label"
        v-model="characterTraits[ability.key]"
      />

    </div>

    <div>
      <button type="submit">
        Create Character
      </button>
    </div>
  </form>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { getSpecies } from '../api/speciesApi'
import { getClasses } from '../api/classApi'
import { getBackgrounds } from '../api/backgroundApi'
import { createCharacter } from '../api/characterApi'
import AbilityScore from '../components/AbilityScore.vue'
//temp
import { login } from '../api/authApi.js'

const abilities = [
  {key: 'str_score', label: 'Strength'},
  {key: 'dex_score', label: 'Dexterity'},
  {key: 'con_score', label: 'Constitution'},
  {key: 'int_score', label: 'Intelligence'},
  {key: 'wis_score', label: 'Wisdom'},
  {key: 'cha_score', label: 'Charisma'},
];

// reactive() creates an object that Vue watches.
//
// If this changes:
const characterTraits = reactive({
  name: '',
  singularClassId: '',
  singularSpeciesId: '',
  backgroundId: '',
  str_score: 10,
  dex_score: 10,
  con_score: 10,
  int_score: 10,
  wis_score: 10,
  cha_score: 10
});

const router = useRouter();

const species = ref([]);

const classes = ref([]);

const backgrounds = ref([]);

onMounted(async () => {
  species.value = await getSpecies();
  classes.value = await getClasses();
  backgrounds.value = await getBackgrounds();
  try {
    const response = await login('test@example.com', 'super-secret-password')
    console.log(response)
  } catch (error) {
    console.error('Login failed:', error)
  }
});

async function saveCharacter(){
  if(!characterTraits.name){
    alert('Name is required');
    return;
  }

  const created = await createCharacter(characterTraits)
  console.log(created);
  const characterId = created?.id

  if (!characterId) {
    alert('Unable to create character. Please try again.')
    return
  }

  await router.push({ path: `/characters/${characterId}` })
}

// Vue automatically updates the page.
</script>