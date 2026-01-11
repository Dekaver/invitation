<script setup lang="ts">
import { computed, defineEmits, defineProps, provide, toRefs } from 'vue';

const props = defineProps<{ modelValue: any }>();
const emit = defineEmits(['update:modelValue']);

const { modelValue } = toRefs(props);

const setValue = (v: any) => emit('update:modelValue', v);

provide('selectSetValue', setValue);
provide('selectValue', computed(() => modelValue.value));
</script>

<template>
  <div class="inline-block">
    <slot />
  </div>
</template>
