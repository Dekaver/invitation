<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

interface Wish {
    id: number;
    guest_name: string;
    message: string;
    created_at: string;
}

interface Wedding {
    id: number;
    slug: string;
    groom_name: string;
    bride_name: string;
}

interface Props {
    wedding: Wedding;
    wishes: Wish[];
    total: number;
}

const props = defineProps<Props>();

const form = useForm({});

const deleteWish = (wishId: number) => {
    if (confirm('Are you sure you want to delete this wish?')) {
        form.delete(`/admin/weddings/${props.wedding.id}/wishes/${wishId}`);
    }
};

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const breadcrumbs = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Admin', href: '/admin' },
    { title: 'Weddings', href: '/admin/weddings' },
    {
        title: `${props.wedding.groom_name} & ${props.wedding.bride_name}`,
        href: `/admin/weddings/${props.wedding.id}/guests`,
    },
    { title: 'Wishes', href: `/admin/weddings/${props.wedding.id}/wishes` },
];
</script>

<template>
    <Head title="Manage Wishes" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6">
            <!-- Breadcrumb -->
            <div class="text-sm text-muted-foreground">
                <Link href="/admin/weddings" class="hover:text-foreground"
                    >Weddings</Link
                >
                <span class="mx-2">/</span>
                {{ props.wedding.groom_name }} & {{ props.wedding.bride_name }}
            </div>

            <!-- Total Wishes -->
            <Card>
                <CardHeader>
                    <CardTitle>Total Wishes: {{ props.total }}</CardTitle>
                </CardHeader>
            </Card>

            <!-- No Wishes -->
            <div v-if="!props.wishes.length" class="py-12 text-center">
                <p class="text-muted-foreground">No wishes received yet</p>
            </div>

            <!-- Wishes List -->
            <div v-else class="grid gap-4 md:grid-cols-2 lg:grid-cols-1">
                <Card v-for="wish in props.wishes" :key="wish.id">
                    <CardHeader>
                        <div class="flex items-start justify-between">
                            <div>
                                <CardTitle class="text-base">{{
                                    wish.guest_name
                                }}</CardTitle>
                                <p class="mt-1 text-xs text-muted-foreground">
                                    {{ formatDate(wish.created_at) }}
                                </p>
                            </div>
                            <Button
                                variant="ghost"
                                size="sm"
                                @click="deleteWish(wish.id)"
                            >
                                🗑️
                            </Button>
                        </div>
                    </CardHeader>
                    <CardContent>
                        <p class="text-sm text-gray-700">{{ wish.message }}</p>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
