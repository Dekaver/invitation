<script setup lang="ts">
import { defineProps, inject } from 'vue';

const props = defineProps<{ value: any }>();
const setValue = inject('selectSetValue') as (v: any) => void;

const onClick = () => {
  if (setValue) setValue(props.value);
};
</script>

<template>
  <div @click="onClick" class="px-2 py-1 hover:bg-muted cursor-pointer">
    <slot />
  </div>
</template>
