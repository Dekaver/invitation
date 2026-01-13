<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

interface Wedding {
    id: number;
    slug: string;
    groom_name: string;
    bride_name: string;
    akad_date: string;
    reception_date: string;
    theme: string;
    guests_count?: number;
}

interface Props {
    weddings: Wedding[];
}

const props = defineProps<Props>();

const themeColor = (theme: string) => {
    const colors: Record<string, string> = {
        classic: 'bg-slate-100 text-slate-800',
        modern: 'bg-blue-100 text-blue-800',
        elegant: 'bg-purple-100 text-purple-800',
    };
    return colors[theme] || 'bg-gray-100 text-gray-800';
};

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};

const breadcrumbs = [
    { title: 'Dashboard', href: '/admin' },
    { title: 'Admin', href: '/admin' },
    { title: 'Weddings', href: '/admin/weddings' },
];
</script>

<template>
    <Head title="Manage Weddings" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Wedding List</h2>
            <div class="flex gap-2">
                <Link href="/admin/weddings/create" as="a">
                    <Button variant="outline">📝 Quick Create</Button>
                </Link>
                <Link href="/admin/weddings/create/wizard" as="a">
                    <Button>✨ Step-by-Step Wizard</Button>
                </Link>
            </div>
        </div>

        <div v-if="!props.weddings.length" class="py-12 text-center">
            <p class="text-muted-foreground">No weddings yet</p>
            <Link href="/admin/weddings/create" as="a">
                <Button variant="link">Create your first wedding</Button>
            </Link>
        </div>

        <div v-else class="overflow-hidden rounded-lg bg-white shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 uppercase"
                        >
                            Couple
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 uppercase"
                        >
                            Akad Date
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 uppercase"
                        >
                            Reception Date
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 uppercase"
                        >
                            Theme
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 uppercase"
                        >
                            Stats
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-700 uppercase"
                        >
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr
                        v-for="wedding in props.weddings"
                        :key="wedding.id"
                        class="hover:bg-gray-50"
                    >
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ wedding.groom_name }} &
                                    {{ wedding.bride_name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ wedding.slug }}
                                </p>
                            </div>
                        </td>
                        <td
                            class="px-6 py-4 text-sm whitespace-nowrap text-gray-700"
                        >
                            {{ formatDate(wedding.akad_date) }}
                        </td>
                        <td
                            class="px-6 py-4 text-sm whitespace-nowrap text-gray-700"
                        >
                            {{ formatDate(wedding.reception_date) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <Badge :class="themeColor(wedding.theme)">{{
                                wedding.theme
                            }}</Badge>
                        </td>
                        <td
                            class="px-6 py-4 text-sm whitespace-nowrap text-gray-700"
                        >
                            <div class="space-y-1">
                                <p>👥 {{ wedding.guests_count || 0 }} guests</p>
                            </div>
                        </td>
                        <td
                            class="px-6 py-4 text-sm font-medium whitespace-nowrap"
                        >
                            <div class="flex gap-2">
                                <Link
                                    :href="`/admin/weddings/${wedding.id}/guests`"
                                    as="a"
                                >
                                    <Button variant="outline" size="sm"
                                        >👥 Guests</Button
                                    >
                                </Link>
                                <Link
                                    :href="`/admin/weddings/${wedding.id}/edit`"
                                    as="a"
                                >
                                    <Button variant="outline" size="sm"
                                        >✏️ Edit</Button
                                    >
                                </Link>
                                <Link
                                    :href="`/inv/${wedding.slug}`"
                                    as="a"
                                    target="_blank"
                                >
                                    <Button variant="outline" size="sm"
                                        >👁️ View</Button
                                    >
                                </Link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
