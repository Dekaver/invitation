<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-linear-to-b from-purple-200 via-white to-pink-100 p-6 md:p-10 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900"
    >
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <Link
                        :href="home()"
                        class="flex flex-col items-center gap-2 font-medium transition-transform hover:scale-105"
                    >
                        <div
                            class="mb-1 flex h-32 w-32 items-center justify-center rounded-full bg-linear-to-br from-fuchsia-500 to-purple-100 p-4 shadow-lg"
                        >
                            <AppLogoIcon
                                class="size-8 fill-current text-white"
                            />
                        </div>
                        <span class="sr-only">{{ title }}</span>
                    </Link>
                    <div class="space-y-2 text-center">
                        <h1
                            class="font-wedding bg-linear-to-r from-purple-600 to-pink-600 bg-clip-text text-2xl font-bold text-transparent"
                        >
                            {{ title }}
                        </h1>
                        <p class="text-center text-sm text-muted-foreground">
                            {{ description }}
                        </p>
                    </div>
                </div>
                <div
                    class="rounded-xl border bg-card/50 p-6 shadow-xl backdrop-blur-sm"
                >
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
