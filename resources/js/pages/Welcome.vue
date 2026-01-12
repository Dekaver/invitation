<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { login, register } from '@/routes';
import { index as admin } from '@/routes/admin';
import { Head, Link } from '@inertiajs/vue3';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Wedding Invitation Maker">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="true"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap"
            rel="stylesheet"
        />
    </Head>

    <!-- Navigation -->
    <nav
        class="fixed top-0 z-50 w-full border-b border-purple-100 bg-white/80 backdrop-blur-md"
    >
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-linear-to-br from-purple-500 to-pink-600"
                    >
                        <AppLogoIcon class="size-5 fill-current text-white" />
                    </div>
                    <span class="font-wedding text-xl text-gray-800"
                        >WeddingInvite</span
                    >
                </div>

                <div class="flex items-center space-x-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="admin()"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:text-purple-600"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:text-purple-600"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="register()"
                            class="rounded-lg bg-linear-to-r from-purple-500 to-pink-600 px-4 py-2 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:from-purple-600 hover:to-pink-700 hover:shadow-xl"
                        >
                            Get Started
                        </Link>
                    </template>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section
        class="relative flex min-h-screen items-center justify-center bg-linear-to-br from-purple-50 via-white to-pink-50 pt-16"
    >
        <div class="absolute inset-0 opacity-30">
            <div
                class="absolute inset-0 bg-linear-to-br from-purple-100/20 to-pink-100/20"
            ></div>
        </div>

        <div
            class="relative mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8"
        >
            <div class="mb-8">
                <h1
                    class="font-wedding mb-6 bg-linear-to-r from-purple-600 via-pink-600 to-purple-800 bg-clip-text p-2 text-5xl text-transparent md:text-7xl lg:text-8xl"
                >
                    Create Beautiful
                </h1>
                <h2
                    class="font-wedding mb-8 bg-linear-to-r from-pink-600 to-purple-600 bg-clip-text p-2 text-4xl text-transparent md:text-6xl lg:text-7xl"
                >
                    Wedding Invitations
                </h2>
                <p
                    class="mx-auto max-w-3xl text-xl leading-relaxed text-gray-600 md:text-2xl"
                >
                    Design stunning digital wedding invitations that your guests
                    will love. Share your special day with elegance and style.
                </p>
            </div>

            <div
                class="mb-16 flex flex-col items-center justify-center gap-4 sm:flex-row"
            >
                <Link
                    v-if="!$page.props.auth.user"
                    :href="register()"
                    class="transform rounded-full bg-linear-to-r from-purple-500 to-pink-600 px-8 py-4 text-lg font-semibold text-white shadow-xl transition-all duration-300 hover:scale-105 hover:from-purple-600 hover:to-pink-700 hover:shadow-2xl"
                >
                    Create Your Invitation
                </Link>
                <Link
                    v-if="$page.props.auth.user"
                    :href="admin()"
                    class="transform rounded-full bg-linear-to-r from-purple-500 to-pink-600 px-8 py-4 text-lg font-semibold text-white shadow-xl transition-all duration-300 hover:scale-105 hover:from-purple-600 hover:to-pink-700 hover:shadow-2xl"
                >
                    Go to Dashboard
                </Link>
                <Link
                    href="#features"
                    class="rounded-full border-2 border-purple-200 px-8 py-4 text-lg font-semibold text-purple-600 transition-all duration-300 hover:bg-purple-50"
                >
                    Learn More
                </Link>
            </div>

            <!-- Preview Cards -->
            <div class="mx-auto grid max-w-5xl gap-6 md:grid-cols-3">
                <div
                    class="rounded-2xl border border-purple-100 bg-white/70 p-6 shadow-lg backdrop-blur-sm"
                >
                    <div
                        class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-linear-to-br from-purple-400 to-pink-500"
                    >
                        <svg
                            class="h-6 w-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-800">
                        Easy to Create
                    </h3>
                    <p class="text-sm text-gray-600">
                        Choose from beautiful templates and customize with your
                        details
                    </p>
                </div>

                <div
                    class="rounded-2xl border border-purple-100 bg-white/70 p-6 shadow-lg backdrop-blur-sm"
                >
                    <div
                        class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-linear-to-br from-pink-400 to-purple-500"
                    >
                        <svg
                            class="h-6 w-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-800">
                        Lightning Fast
                    </h3>
                    <p class="text-sm text-gray-600">
                        Send invitations instantly to all your guests
                    </p>
                </div>

                <div
                    class="rounded-2xl border border-purple-100 bg-white/70 p-6 shadow-lg backdrop-blur-sm"
                >
                    <div
                        class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-linear-to-br from-purple-500 to-pink-600"
                    >
                        <svg
                            class="h-6 w-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-800">
                        Elegant Design
                    </h3>
                    <p class="text-sm text-gray-600">
                        Beautiful templates that match your wedding theme
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2
                    class="font-wedding mb-4 text-4xl text-gray-800 md:text-5xl"
                >
                    Why Choose WeddingInvite?
                </h2>
                <p class="mx-auto max-w-2xl text-xl text-gray-600">
                    Everything you need to create and manage beautiful wedding
                    invitations
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="text-center">
                    <div
                        class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-br from-purple-400 to-pink-500"
                    >
                        <svg
                            class="h-8 w-8 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">
                        Custom Templates
                    </h3>
                    <p class="text-gray-600">
                        Choose from elegant designs or create your own custom
                        invitation
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-br from-pink-400 to-purple-500"
                    >
                        <svg
                            class="h-8 w-8 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">
                        Guest Management
                    </h3>
                    <p class="text-gray-600">
                        Easily manage your guest list and track RSVPs
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-br from-purple-500 to-pink-600"
                    >
                        <svg
                            class="h-8 w-8 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">
                        Email Integration
                    </h3>
                    <p class="text-gray-600">
                        Send beautiful invitations directly to your guests'
                        email
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-br from-pink-500 to-purple-600"
                    >
                        <svg
                            class="h-8 w-8 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                            ></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-800">
                        Analytics
                    </h3>
                    <p class="text-gray-600">
                        Track opens, RSVPs, and engagement with your invitations
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-linear-to-r from-purple-500 to-pink-600 py-20">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="font-wedding mb-6 text-4xl text-white md:text-5xl">
                Ready to Create Your Perfect Invitation?
            </h2>
            <p class="mx-auto mb-8 max-w-2xl text-xl text-purple-100">
                Join thousands of couples who have created beautiful wedding
                invitations with WeddingInvite
            </p>
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <Link
                    v-if="!$page.props.auth.user"
                    :href="register()"
                    class="transform rounded-full bg-white px-8 py-4 text-lg font-semibold text-purple-600 shadow-xl transition-all duration-300 hover:scale-105 hover:bg-gray-50 hover:shadow-2xl"
                >
                    Start Creating Now
                </Link>
                <Link
                    v-if="$page.props.auth.user"
                    :href="admin()"
                    class="transform rounded-full bg-white px-8 py-4 text-lg font-semibold text-purple-600 shadow-xl transition-all duration-300 hover:scale-105 hover:bg-gray-50 hover:shadow-2xl"
                >
                    Go to Dashboard
                </Link>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between md:flex-row">
                <div class="mb-4 flex items-center space-x-2 md:mb-0">
                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-linear-to-br from-purple-500 to-pink-600"
                    >
                        <AppLogoIcon class="size-5 fill-current text-white" />
                    </div>
                    <span class="font-wedding text-xl text-gray-800"
                        >WeddingInvite</span
                    >
                </div>
                <div class="text-sm text-gray-600">
                    © 2026 WeddingInvite. Made with ❤️ for happy couples.
                </div>
            </div>
        </div>
    </footer>
</template>
