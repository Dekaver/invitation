<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-center text-sm font-medium text-green-600 dark:border-green-800 dark:bg-green-900/20"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label
                        for="email"
                        class="text-sm font-medium text-foreground"
                        >Email address</Label
                    >
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="your@email.com"
                        class="h-11"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label
                            for="password"
                            class="text-sm font-medium text-foreground"
                            >Password</Label
                        >
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm text-rose-600 hover:text-rose-700 dark:text-rose-400 dark:hover:text-rose-300"
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        class="h-11"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label
                        for="remember"
                        class="flex cursor-pointer items-center space-x-3"
                    >
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span class="text-sm text-foreground">Remember me</span>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="mt-4 h-11 w-full bg-gradient-to-r from-rose-500 to-pink-600 font-medium text-white shadow-lg transition-all duration-200 hover:from-rose-600 hover:to-pink-700 hover:shadow-xl"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" class="mr-2" />
                    {{ processing ? 'Signing in...' : 'Sign in' }}
                </Button>
            </div>

            <div
                class="text-center text-sm text-muted-foreground"
                v-if="canRegister"
            >
                Don't have an account?
                <TextLink
                    :href="register()"
                    :tabindex="5"
                    class="font-medium text-rose-600 hover:text-rose-700 dark:text-rose-400 dark:hover:text-rose-300"
                    >Sign up</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
