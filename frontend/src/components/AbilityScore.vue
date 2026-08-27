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

    const props = defineProps({
        abilityLabel: String,
        modelValue: Number,
    });

    const emit = defineEmits([
        'update:modelValue'
    ]);

    const model = computed({
        get() {
            return props.modelValue;
        },
        set(newValue) {
            emit('update:modelValue', newValue);
        },
      });
    
    const modifier = computed(() => {
        return Math.floor((props.modelValue - 10) / 2);
    });
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