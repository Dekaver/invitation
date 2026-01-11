<script setup lang="ts">
import { inject } from 'vue';

const value = inject('selectValue');
</script>

<template>
  <span>{{ value }}</span>
</template>
