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

interface Wedding {
    id: number;
    slug: string;
    groom_short_name: string;
    groom_name: string;
    bride_short_name: string;
    bride_name: string;
    groom_father: string;
    groom_mother: string;
    bride_father: string;
    bride_mother: string;
    akad_date: string;
    akad_start: string;
    akad_end: string;
    akad_location: string;
    reception_date: string;
    reception_start: string;
    reception_end: string;
    reception_location: string;
    map_url: string;
    map_embed_url: string;
    theme: string;
}

interface Props {
    wedding: Wedding;
}

const props = defineProps<Props>();

const form = useForm({
    slug: props.wedding.slug,
    groom_short_name: props.wedding.groom_short_name,
    groom_name: props.wedding.groom_name,
    bride_short_name: props.wedding.bride_short_name,
    bride_name: props.wedding.bride_name,
    groom_father: props.wedding.groom_father,
    groom_mother: props.wedding.groom_mother,
    bride_father: props.wedding.bride_father,
    bride_mother: props.wedding.bride_mother,
    akad_date: props.wedding.akad_date && props.wedding.akad_date.split('T')[0],
    akad_start: props.wedding.akad_start,
    akad_end: props.wedding.akad_end,
    akad_location: props.wedding.akad_location,
    reception_date:
        props.wedding.reception_date &&
        props.wedding.reception_date.split('T')[0],
    reception_start: props.wedding.reception_start,
    reception_end: props.wedding.reception_end,
    reception_location: props.wedding.reception_location,
    map_url: props.wedding.map_url,
    map_embed_url: props.wedding.map_embed_url,
    theme: props.wedding.theme,
});

const themes = ['classic', 'modern', 'elegant'];

const submit = () => {
    form.put(`/admin/weddings/${props.wedding.id}`, {
        onError: () => {},
    });
};

const deleteWedding = () => {
    if (
        confirm(
            'Are you sure you want to delete this wedding? This action cannot be undone.',
        )
    ) {
        form.delete(`/admin/weddings/${props.wedding.id}`);
    }
};

const breadcrumbs = [
    { title: 'Dashboard', href: '/admin' },
    { title: 'Admin', href: '/admin' },
    { title: 'Weddings', href: '/admin/weddings' },
    { title: 'Edit', href: `/admin/weddings/${props.wedding.id}/edit` },
];
</script>

<template>
    <Head title="Edit Wedding" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6">
            <!-- Couple Information Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Informasi Pasangan</CardTitle>
                </CardHeader>
                <CardContent>
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- Couple Names -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <Label for="groom_short_name">
                                    Nama Pendek Pria *
                                </Label>
                                <Input
                                    id="groom_short_name"
                                    v-model="form.groom_short_name"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.groom_short_name,
                                    }"
                                />
                                <p
                                    v-if="form.errors.groom_short_name"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ form.errors.groom_name }}
                                </p>
                            </div>
                            <div>
                                <Label for="bride_short_name"
                                    >Nama Pendek Wanita *</Label
                                >
                                <Input
                                    id="bride_short_name"
                                    v-model="form.bride_short_name"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.bride_short_name,
                                    }"
                                />
                                <p
                                    v-if="form.errors.bride_short_name"
                                    class="mt-1 text-xs text-red-500"
                                >
                                    {{ form.errors.bride_short_name }}
                                </p>
                            </div>
                        </div>
                        <!-- Couple Names -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <Label for="groom_name">
                                    Nama Pengantin Pria *
                                </Label>
                                <Input
                                    id="groom_name"
                                    v-model="form.groom_name"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.groom_name,
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
                                <Label for="bride_name"
                                    >Nama Pengantin Wanita *</Label
                                >
                                <Input
                                    id="bride_name"
                                    v-model="form.bride_name"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.bride_name,
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
                                <Label for="groom_father"
                                    >Ayah Pengantin Pria *</Label
                                >
                                <Input
                                    id="groom_father"
                                    v-model="form.groom_father"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.groom_father,
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
                                <Label for="groom_mother"
                                    >Ibu Pengantin Pria *</Label
                                >
                                <Input
                                    id="groom_mother"
                                    v-model="form.groom_mother"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.groom_mother,
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
                                <Label for="bride_father"
                                    >Ayah Pengantin Wanita *</Label
                                >
                                <Input
                                    id="bride_father"
                                    v-model="form.bride_father"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.bride_father,
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
                                <Label for="bride_mother"
                                    >Ibu Pengantin Wanita *</Label
                                >
                                <Input
                                    id="bride_mother"
                                    v-model="form.bride_mother"
                                    type="text"
                                    :class="{
                                        'border-red-500':
                                            form.errors.bride_mother,
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
                    </form>
                </CardContent>
            </Card>

            <!-- Event Details Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Detail Acara</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="space-y-6">
                        <!-- Akad Date & Time -->
                        <div class="grid grid-cols-5 gap-4">
                            <div>
                                <Label for="akad_date">Tanggal Akad *</Label>
                                {{ typeof form.akad_date }}
                                <Input
                                    id="akad_date"
                                    v-model="form.akad_date"
                                    type="date"
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
                                <Label for="akad_start">Waktu Mulai Akad</Label>
                                <Input
                                    id="akad_start"
                                    v-model="form.akad_start"
                                    type="time"
                                />
                            </div>
                            <div>
                                <Label for="akad_end">Waktu Selesai Akad</Label>
                                <Input
                                    id="akad_end"
                                    v-model="form.akad_end"
                                    type="time"
                                />
                            </div>
                            <div>
                                <Label for="akad_location">Lokasi Akad *</Label>
                                <Input
                                    id="akad_location"
                                    v-model="form.akad_location"
                                    type="text"
                                />
                            </div>
                        </div>

                        <!-- Reception Date & Time -->
                        <div class="grid grid-cols-5 gap-4">
                            <div>
                                <Label for="reception_date"
                                    >Tanggal Resepsi *</Label
                                >
                                <Input
                                    id="reception_date"
                                    v-model="form.reception_date"
                                    type="date"
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
                                    >Waktu Mulai Resepsi</Label
                                >
                                <Input
                                    id="reception_start"
                                    v-model="form.reception_start"
                                    type="time"
                                    step="3600000"
                                />
                            </div>
                            <div>
                                <Label for="reception_end"
                                    >Waktu Selesai Resepsi</Label
                                >
                                <Input
                                    id="reception_end"
                                    v-model="form.reception_end"
                                    type="time"
                                />
                            </div>
                            <div>
                                <Label for="reception_location"
                                    >Tempat Resepsi *</Label
                                >
                                <Input
                                    id="reception_location"
                                    v-model="form.reception_location"
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Settings Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Pengaturan</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="space-y-6">
                        <!-- Slug -->
                        <div>
                            <Label for="slug">URL Slug *</Label>
                            <Input
                                id="slug"
                                v-model="form.slug"
                                type="text"
                                disabled
                                class="bg-gray-100"
                            />
                            <p class="mt-1 text-xs text-muted-foreground">
                                Tidak dapat diubah
                            </p>
                        </div>

                        <!-- Theme -->
                        <div>
                            <Label for="theme">Tema *</Label>
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
                                        {{
                                            t.charAt(0).toUpperCase() +
                                            t.slice(1)
                                        }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                        </div>

                        <!-- Map URL -->
                        <div>
                            <Label for="map_url">Link Google Maps</Label>
                            <Input
                                id="map_url"
                                v-model="form.map_url"
                                type="url"
                                placeholder="https://maps.google.com/..."
                            />
                            <p class="mt-1 text-xs text-muted-foreground">
                                Link untuk tombol "Buka di Google Maps"
                            </p>
                        </div>

                        <!-- Map Embed URL -->
                        <div>
                            <Label for="map_embed_url"
                                >Embed URL Google Maps</Label
                            >
                            <Input
                                id="map_embed_url"
                                v-model="form.map_embed_url"
                                type="url"
                                placeholder="https://www.google.com/maps/embed?..."
                            />
                            <p class="mt-1 text-xs text-muted-foreground">
                                URL embed untuk menampilkan peta
                            </p>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Actions Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Aksi</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="flex gap-4">
                        <Button
                            type="submit"
                            :disabled="form.processing"
                            @click="submit"
                        >
                            {{
                                form.processing
                                    ? 'Memperbarui...'
                                    : 'Perbarui Pernikahan'
                            }}
                        </Button>
                        <Link href="/admin/weddings" as="a">
                            <Button variant="outline">Batal</Button>
                        </Link>
                        <Button
                            type="button"
                            variant="destructive"
                            @click="deleteWedding"
                            :disabled="form.processing"
                        >
                            Hapus
                        </Button>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
