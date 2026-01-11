<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const props = defineProps({
    stats: {
        type: Object as () => Record<string, any>,
        default: () => ({
            totalWeddings: 0,
            totalGuests: 0,
            totalWishes: 0,
            upcomingWeddings: 0,
        }),
    },
});

const breadcrumbs = [
    { title: 'Dashboard', href: '/admin' },
    { title: 'Admin', href: '/admin' },
];
</script>

<template>
    <Head title="Admin Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Weddings -->
            <Card>
                <CardHeader
                    class="flex flex-row items-center justify-between space-y-0 pb-2"
                >
                    <CardTitle class="text-sm font-medium"
                        >Total Weddings</CardTitle
                    >
                    <span class="text-2xl">💒</span>
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        {{ props.stats.totalWeddings || 0 }}
                    </div>
                    <p class="text-xs text-muted-foreground">
                        All registered weddings
                    </p>
                </CardContent>
            </Card>

            <!-- Total Guests -->
            <Card>
                <CardHeader
                    class="flex flex-row items-center justify-between space-y-0 pb-2"
                >
                    <CardTitle class="text-sm font-medium"
                        >Total Guests</CardTitle
                    >
                    <span class="text-2xl">👥</span>
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        {{ props.stats.totalGuests || 0 }}
                    </div>
                    <p class="text-xs text-muted-foreground">
                        Guest invitations
                    </p>
                </CardContent>
            </Card>

            <!-- Total Wishes -->
            <Card>
                <CardHeader
                    class="flex flex-row items-center justify-between space-y-0 pb-2"
                >
                    <CardTitle class="text-sm font-medium"
                        >Total Wishes</CardTitle
                    >
                    <span class="text-2xl">✨</span>
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        {{ props.stats.totalWishes || 0 }}
                    </div>
                    <p class="text-xs text-muted-foreground">Wishes received</p>
                </CardContent>
            </Card>

            <!-- Upcoming Events -->
            <Card>
                <CardHeader
                    class="flex flex-row items-center justify-between space-y-0 pb-2"
                >
                    <CardTitle class="text-sm font-medium">Upcoming</CardTitle>
                    <span class="text-2xl">📅</span>
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">
                        {{ props.stats.upcomingWeddings || 0 }}
                    </div>
                    <p class="text-xs text-muted-foreground">
                        Coming this month
                    </p>
                </CardContent>
            </Card>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h2 class="mb-4 text-lg font-semibold">Quick Actions</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <Link href="/admin/weddings" as="a">
                    <Button class="w-full" variant="outline">
                        <span class="mr-2">💒</span> Manage Weddings
                    </Button>
                </Link>
                <Link href="/admin/weddings/create" as="a">
                    <Button class="w-full" variant="outline">
                        <span class="mr-2">➕</span> Create Wedding
                    </Button>
                </Link>
                <Link href="/dashboard" as="a">
                    <Button class="w-full" variant="outline">
                        <span class="mr-2">🏠</span> Back to Dashboard
                    </Button>
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
