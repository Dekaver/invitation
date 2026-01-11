<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

interface Guest {
    id: number;
    uuid: string;
    name: string;
    phone: string;
    rsvp_status: string;
    total_guest: number;
}

interface Wedding {
    id: number;
    slug: string;
    groom_name: string;
    bride_name: string;
}

interface Props {
    wedding: Wedding;
    guests: Guest[];
    stats?: {
        total: number;
        attending: number;
        notAttending: number;
        maybe: number;
    };
}

const props = defineProps<Props>();

const rsvpColors: Record<string, string> = {
    yes: 'bg-green-100 text-green-800',
    no: 'bg-red-100 text-red-800',
    maybe: 'bg-yellow-100 text-yellow-800',
};

const form = useForm({});

const deleteGuest = (guestId: number) => {
    if (confirm('Are you sure you want to delete this guest?')) {
        form.delete(`/admin/weddings/${props.wedding.id}/guests/${guestId}`);
    }
};

const breadcrumbs = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Admin', href: '/admin' },
    { title: 'Weddings', href: '/admin/weddings' },
    {
        title: `${props.wedding.groom_name} & ${props.wedding.bride_name}`,
        href: `/admin/weddings/${props.wedding.id}/guests`,
    },
];
</script>

<template>
    <Head title="Manage Guests" />
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

            <!-- Stats -->
            <div v-if="props.stats" class="grid gap-4 md:grid-cols-4">
                <Card>
                    <CardContent class="pt-6">
                        <div class="text-2xl font-bold">
                            {{ props.stats.total }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Total Guests
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardContent class="pt-6">
                        <div class="text-2xl font-bold text-green-600">
                            {{ props.stats.attending }}
                        </div>
                        <p class="text-xs text-muted-foreground">Attending</p>
                    </CardContent>
                </Card>
                <Card>
                    <CardContent class="pt-6">
                        <div class="text-2xl font-bold text-red-600">
                            {{ props.stats.notAttending }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Not Attending
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardContent class="pt-6">
                        <div class="text-2xl font-bold text-yellow-600">
                            {{ props.stats.maybe }}
                        </div>
                        <p class="text-xs text-muted-foreground">Maybe</p>
                    </CardContent>
                </Card>
            </div>

            <!-- Add Guest Button -->
            <div>
                <Link
                    :href="`/admin/weddings/${props.wedding.id}/guests/create`"
                    as="a"
                >
                    <Button>➕ Add Guest</Button>
                </Link>
            </div>

            <!-- Guests Table -->
            <div v-if="!props.guests.length" class="py-12 text-center">
                <p class="mb-4 text-muted-foreground">No guests added yet</p>
                <Link
                    :href="`/admin/weddings/${props.wedding.id}/guests/create`"
                    as="a"
                >
                    <Button variant="link">Add your first guest</Button>
                </Link>
            </div>

            <Card v-else>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="px-4 py-3 text-left font-semibold">
                                    Name
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    Phone
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    Status
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    Total
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    Link
                                </th>
                                <th class="px-4 py-3 text-left font-semibold">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="guest in props.guests"
                                :key="guest.id"
                                class="border-b hover:bg-gray-50"
                            >
                                <td class="px-4 py-3">{{ guest.name }}</td>
                                <td class="px-4 py-3">{{ guest.phone }}</td>
                                <td class="px-4 py-3">
                                    <Badge
                                        :class="rsvpColors[guest.rsvp_status]"
                                    >
                                        {{
                                            guest.rsvp_status === 'yes'
                                                ? 'Attending'
                                                : guest.rsvp_status === 'no'
                                                  ? 'Not Attending'
                                                  : 'Maybe'
                                        }}
                                    </Badge>
                                </td>
                                <td class="px-4 py-3">
                                    {{ guest.total_guest }}
                                </td>
                                <td class="px-4 py-3">
                                    <code
                                        class="rounded bg-gray-100 px-2 py-1 text-xs"
                                        >{{
                                            guest.uuid.substring(0, 8)
                                        }}...</code
                                    >
                                </td>
                                <td class="space-x-2 px-4 py-3">
                                    <Link
                                        :href="`/admin/weddings/${props.wedding.id}/guests/${guest.id}/edit`"
                                        as="a"
                                    >
                                        <Button variant="outline" size="sm"
                                            >Edit</Button
                                        >
                                    </Link>
                                    <Button
                                        variant="destructive"
                                        size="sm"
                                        @click="deleteGuest(guest.id)"
                                    >
                                        Delete
                                    </Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </Card>
        </div>
    </AppLayout>
</template>
