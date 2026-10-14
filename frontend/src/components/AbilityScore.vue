<template>
    <div class="ability-score">
        <h3> {{ abilityLabel }}</h3>

        <input
          type="number"
          v-model.number="model"
        >

        <p class="ability-modifier">
            {{ formattedModifier }}
        </p>

    </div>
</template>

<script setup>
    import { computed } from 'vue';

    // A prop is data coming from the parent component.
    // abilityLabel is the text the parent sends in, like "Strength".
    // modelValue is the current number the parent sends in, like 10 or 14.
    // In plain English: the parent says "here is the label and the value".
    const props = defineProps({
        abilityLabel: String,
        modelValue: Number,
    });

    // emit is how a child tells the parent, "something changed".
    // This line says: "I am allowed to send an event named update:modelValue".
    // That event is the Vue way of doing a two-way binding with custom components.
    const emit = defineEmits([
        'update:modelValue'
    ]);

    // model is a computed value that connects the input field to the parent value.
    // get() means: "when the field needs to show a value, give it props.modelValue".
    // set(newValue) means: "when the user changes the field, send that new number up to the parent".
    // So this is the bridge between the child input and the parent data.
    const model = computed({
        get() {
            return props.modelValue;
        },
        set(newValue) {
            emit('update:modelValue', newValue);
        },
      });
    
    // This is a calculated value, not a saved value.
    // It takes the ability score and converts it to the usual D&D modifier.
    // Example: 10 -> 0, 12 -> 1, 8 -> -1, 15 -> 2.
    // Math.floor removes the decimal part, so values like 1.5 become 1.
    const modifier = computed(() => {
        return Math.floor((props.modelValue - 10) / 2);
    });

    // This is just a display helper.
    // If the modifier is positive, we add a + sign so it reads "+2" instead of "2".
    // If it is negative, we leave it as "-1".
    // We return a string because we want to show text in the template.
    const formattedModifier = computed(() => {
        if(modifier.value >= 0) {
            return `+${modifier.value}`;
        }
        return `${modifier.value}`;
    })

</script>

<style scoped>
    .ability-score {
        border: 1px solid gray;
        border-radius: 8px;
        padding: 10px;
        width: 120px;
        text-align: center;
        margin: 8px;
    }
    .ability-score h3 {
        margin-top: 0;
    }
    .ability-score input {
        width: 60px;
        text-align: center;
        font-size: 1.2rem;
    }
    .ability-modifier {
        font-weight: bold;
        margin-top: 10px;
    }
</style>