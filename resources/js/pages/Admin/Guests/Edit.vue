<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

interface Wedding {
    id: number;
    groom_name: string;
    bride_name: string;
}

interface Guest {
    id: number;
    uuid: string;
    name: string;
    phone: string;
    rsvp_status: string;
    total_guest: number;
}

interface Props {
    wedding: Wedding;
    guest: Guest;
}

const props = defineProps<Props>();

const form = useForm({
    name: props.guest.name,
    phone: props.guest.phone,
    rsvp_status: props.guest.rsvp_status,
    total_guest: props.guest.total_guest,
});

const showTotalGuest = ref(props.guest.rsvp_status === 'yes');

watch(
    () => form.rsvp_status,
    (status) => {
        showTotalGuest.value = status === 'yes';
    },
);

const submit = () => {
    form.put(`/admin/weddings/${props.wedding.id}/guests/${props.guest.id}`, {
        onError: () => {},
    });
};

const deleteGuest = () => {
    if (confirm('Are you sure you want to delete this guest?')) {
        form.delete(
            `/admin/weddings/${props.wedding.id}/guests/${props.guest.id}`,
        );
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
    {
        title: 'Edit Guest',
        href: `/admin/weddings/${props.wedding.id}/guests/${props.guest.id}/edit`,
    },
];
</script>

<template>
    <Head title="Edit Guest" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Card class="max-w-xl">
            <CardHeader>
                <CardTitle
                    >{{ props.wedding.groom_name }} &
                    {{ props.wedding.bride_name }}</CardTitle
                >
                <p class="mt-2 text-sm text-muted-foreground">
                    UUID: {{ props.guest.uuid }}
                </p>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Guest Name -->
                    <div>
                        <Label for="name">Guest Name *</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            type="text"
                            :class="{ 'border-red-500': form.errors.name }"
                        />
                        <p
                            v-if="form.errors.name"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <Label for="phone">Phone Number</Label>
                        <Input
                            id="phone"
                            v-model="form.phone"
                            type="tel"
                            :class="{ 'border-red-500': form.errors.phone }"
                        />
                        <p
                            v-if="form.errors.phone"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.phone }}
                        </p>
                    </div>

                    <!-- RSVP Status -->
                    <div>
                        <Label for="rsvp_status">RSVP Status *</Label>
                        <Select v-model="form.rsvp_status">
                            <SelectTrigger>
                                <SelectValue />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="yes"
                                    >✅ Attending</SelectItem
                                >
                                <SelectItem value="no"
                                    >❌ Not Attending</SelectItem
                                >
                                <SelectItem value="maybe">❓ Maybe</SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Total Guest (conditional) -->
                    <transition>
                        <div v-show="showTotalGuest">
                            <Label for="total_guest"
                                >Total Guests (including self) *</Label
                            >
                            <Input
                                id="total_guest"
                                v-model.number="form.total_guest"
                                type="number"
                                min="1"
                                max="10"
                                :class="{
                                    'border-red-500': form.errors.total_guest,
                                }"
                            />
                            <p class="mt-1 text-xs text-muted-foreground">
                                Maximum 10 guests
                            </p>
                            <p
                                v-if="form.errors.total_guest"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.total_guest }}
                            </p>
                        </div>
                    </transition>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4">
                        <Button type="submit" :disabled="form.processing">
                            {{
                                form.processing ? 'Updating...' : 'Update Guest'
                            }}
                        </Button>
                        <Link
                            :href="`/admin/weddings/${props.wedding.id}/guests`"
                            as="a"
                        >
                            <Button variant="outline">Cancel</Button>
                        </Link>
                        <Button
                            type="button"
                            variant="destructive"
                            @click="deleteGuest"
                            :disabled="form.processing"
                        >
                            Delete
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </AppLayout>
</template>
