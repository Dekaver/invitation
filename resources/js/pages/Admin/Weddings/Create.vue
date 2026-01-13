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

const form = useForm({
    slug: '',
    groom_name: '',
    bride_name: '',
    groom_father: '',
    groom_mother: '',
    bride_father: '',
    bride_mother: '',
    akad_date: '',
    akad_start: '',
    akad_end: '',
    akad_location: '',
    reception_date: '',
    reception_start: '',
    reception_end: '',
    reception_location: '',
    map_url: '',
    map_embed_url: '',
    theme: 'classic',
});

const themes = ['classic', 'modern', 'elegant'];

const submit = () => {
    form.post('/admin/weddings', {
        onError: () => {},
    });
};

const breadcrumbs = [
    { title: 'Dashboard', href: '/admin' },
    { title: 'Admin', href: '/admin' },
    { title: 'Weddings', href: '/admin/weddings' },
    { title: 'Create', href: '/admin/weddings/create' },
];
</script>

<template>
    <Head title="Create Wedding" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Card class="max-w-2xl">
            <CardHeader>
                <CardTitle>Wedding Details</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Couple Names -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="groom_name">Groom Name *</Label>
                            <Input
                                id="groom_name"
                                v-model="form.groom_name"
                                type="text"
                                placeholder="John"
                                :class="{
                                    'border-red-500': form.errors.groom_name,
                                }"
                            />
                            <p
                                v-if="form.errors.groom_name"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.groom_name }}
                            </p>
                        </div>
                        <div>
                            <Label for="bride_name">Bride Name *</Label>
                            <Input
                                id="bride_name"
                                v-model="form.bride_name"
                                type="text"
                                placeholder="Sarah"
                                :class="{
                                    'border-red-500': form.errors.bride_name,
                                }"
                            />
                            <p
                                v-if="form.errors.bride_name"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.bride_name }}
                            </p>
                        </div>
                    </div>

                    <!-- Parents -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="groom_father">Groom Father *</Label>
                            <Input
                                id="groom_father"
                                v-model="form.groom_father"
                                type="text"
                                placeholder="John Sr."
                                :class="{
                                    'border-red-500': form.errors.groom_father,
                                }"
                            />
                            <p
                                v-if="form.errors.groom_father"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.groom_father }}
                            </p>
                        </div>
                        <div>
                            <Label for="groom_mother">Groom Mother *</Label>
                            <Input
                                id="groom_mother"
                                v-model="form.groom_mother"
                                type="text"
                                placeholder="Jane"
                                :class="{
                                    'border-red-500': form.errors.groom_mother,
                                }"
                            />
                            <p
                                v-if="form.errors.groom_mother"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.groom_mother }}
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <Label for="bride_father">Bride Father *</Label>
                            <Input
                                id="bride_father"
                                v-model="form.bride_father"
                                type="text"
                                placeholder="Michael"
                                :class="{
                                    'border-red-500': form.errors.bride_father,
                                }"
                            />
                            <p
                                v-if="form.errors.bride_father"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.bride_father }}
                            </p>
                        </div>
                        <div>
                            <Label for="bride_mother">Bride Mother *</Label>
                            <Input
                                id="bride_mother"
                                v-model="form.bride_mother"
                                type="text"
                                placeholder="Emily"
                                :class="{
                                    'border-red-500': form.errors.bride_mother,
                                }"
                            />
                            <p
                                v-if="form.errors.bride_mother"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.bride_mother }}
                            </p>
                        </div>
                    </div>

                    <!-- Slug -->
                    <div>
                        <Label for="slug">URL Slug *</Label>
                        <Input
                            id="slug"
                            v-model="form.slug"
                            type="text"
                            placeholder="john-sarah-2026"
                            :class="{ 'border-red-500': form.errors.slug }"
                        />
                        <p class="mt-1 text-xs text-muted-foreground">
                            Lowercase, hyphens only
                        </p>
                        <p
                            v-if="form.errors.slug"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ form.errors.slug }}
                        </p>
                    </div>

                    <!-- Akad Date & Time -->
                    <div class="grid grid-cols-5 gap-4">
                        <div>
                            <Label for="akad_date">Akad Date *</Label>
                            <Input
                                id="akad_date"
                                v-model="form.akad_date"
                                type="datetime-local"
                                :class="{
                                    'border-red-500': form.errors.akad_date,
                                }"
                            />
                            <p
                                v-if="form.errors.akad_date"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.akad_date }}
                            </p>
                        </div>
                        <div>
                            <Label for="akad_start">Akad Start Time</Label>
                            <Input
                                id="akad_start"
                                v-model="form.akad_start"
                                type="time"
                            />
                        </div>
                        <div>
                            <Label for="akad_end">Akad End Time</Label>
                            <Input
                                id="akad_end"
                                v-model="form.akad_end"
                                type="time"
                            />
                        </div>
                        <div>
                            <Label for="akad_location">Akad Location *</Label>
                            <Input
                                id="akad_location"
                                v-model="form.akad_location"
                                type="text"
                                placeholder="Mosque Name"
                            />
                        </div>
                    </div>

                    <!-- Reception Date & Time -->
                    <div class="grid grid-cols-5 gap-4">
                        <div>
                            <Label for="reception_date">Reception Date *</Label>
                            <Input
                                id="reception_date"
                                v-model="form.reception_date"
                                type="datetime-local"
                                :class="{
                                    'border-red-500':
                                        form.errors.reception_date,
                                }"
                            />
                            <p
                                v-if="form.errors.reception_date"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.reception_date }}
                            </p>
                        </div>
                        <div>
                            <Label for="reception_start"
                                >Reception Start Time</Label
                            >
                            <Input
                                id="reception_start"
                                v-model="form.reception_start"
                                type="time"
                            />
                        </div>
                        <div>
                            <Label for="reception_end"
                                >Reception End Time</Label
                            >
                            <Input
                                id="reception_end"
                                v-model="form.reception_end"
                                type="time"
                            />
                        </div>
                        <div>
                            <Label for="reception_location"
                                >Reception Venue *</Label
                            >
                            <Input
                                id="reception_location"
                                v-model="form.reception_location"
                                type="text"
                                placeholder="Hotel Name"
                            />
                        </div>
                    </div>

                    <!-- Theme -->
                    <div>
                        <Label for="theme">Theme *</Label>
                        <Select v-model="form.theme">
                            <SelectTrigger>
                                <SelectValue />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem
                                    v-for="t in themes"
                                    :key="t"
                                    :value="t"
                                >
                                    {{ t.charAt(0).toUpperCase() + t.slice(1) }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>

                    <!-- Map URL -->
                    <div>
                        <Label for="map_url">Google Maps Link</Label>
                        <Input
                            id="map_url"
                            v-model="form.map_url"
                            type="url"
                            placeholder="https://maps.google.com/..."
                        />
                        <p class="mt-1 text-xs text-muted-foreground">
                            Link for "Open in Google Maps" button
                        </p>
                    </div>

                    <!-- Map Embed URL -->
                    <div>
                        <Label for="map_embed_url">Google Maps Embed URL</Label>
                        <Input
                            id="map_embed_url"
                            v-model="form.map_embed_url"
                            type="url"
                            placeholder="https://www.google.com/maps/embed?..."
                        />
                        <p class="mt-1 text-xs text-muted-foreground">
                            Embed URL to display the map
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4">
                        <Button type="submit" :disabled="form.processing">
                            {{
                                form.processing
                                    ? 'Creating...'
                                    : 'Create Wedding'
                            }}
                        </Button>
                        <Link href="/admin/weddings" as="a">
                            <Button variant="outline">Cancel</Button>
                        </Link>
                    </div>
                </form>
            </CardContent>
        </Card>
    </AppLayout>
</template>
