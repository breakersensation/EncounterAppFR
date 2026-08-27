<template>
  <form @submit.prevent="saveCharacter">
    <div v-if="characterData">
      <h1>Character Sheet</h1>
      <p>Character Name: {{ characterData?.name }}</p>
      <p>Species: {{ characterData?.race?.name }}</p>
      <p>Level: {{ characterLevel }}</p>
      <p>Character Class(es):</p>
      <ul v-if="characterData?.classes?.length">
        <li v-for="singleClass in characterData.classes" 
            :key="singleClass.id">
          {{ singleClass.class_definition?.name }} - {{ singleClass.class_level }}
        </li>
      </ul>
      <p>Background: {{ characterData?.background?.name }}</p>
      <p>Alignment: TODO</p>
      <p>Abilities</p>
      <AbilityScore
        v-for="ability in abilities"
        :key="ability.key"
        :abilityLabel="ability.label"
        v-model="characterData[ability.key]"
      />
    </div>
    <div>
      <button type="submit">
        Save Changes
      </button>
    </div>
  </form>
</template>

<script setup>
import { computed, onMounted, ref, reactive } from 'vue'
import { useRoute } from 'vue-router'
import { getCharacter, updateCharacter } from '../api/characterApi'
import AbilityScore from '../components/AbilityScore.vue'

const route = useRoute();

const characterId = route.params.id;
const characterData = reactive({
  name: '',
  singularSpeciesId: '',
  singularClassId: '',
  backgroundId: '',
  str_score: 10,
  dex_score: 10,
  con_score: 10,
  int_score: 10,
  wis_score: 10,
  cha_score: 10
});
const characterClasses = computed(() => characterData.value?.classes ?? []);
const characterLevel = computed(() =>
  characterClasses.value.reduce((total, singleClass) => {
    return total + Number(singleClass.class_level ?? 0)
  }, 0)
);
const abilities = [
  {key: 'str_score', label: 'Strength'},
  {key: 'dex_score', label: 'Dexterity'},
  {key: 'con_score', label: 'Constitution'},
  {key: 'int_score', label: 'Intelligence'},
  {key: 'wis_score', label: 'Wisdom'},
  {key: 'cha_score', label: 'Charisma'},
];

onMounted(async () => {
  // characterData.value = await getCharacter(characterId)
  const data = await getCharacter(characterId);
  Object.assign(characterData, data);
  console.log('Character Data:');
  console.log(characterData);
  console.log(characterData.name);
});

async function saveCharacter() {
  if(!characterData.name){
    alert('Character name is required');
    return;
  }

  const updated = await updateCharacter(characterId, characterData);
  console.log('Updated Character:');
  console.log(updated);
  const data = await getCharacter(characterId);
  Object.assign(characterData, data);
}
</script>
