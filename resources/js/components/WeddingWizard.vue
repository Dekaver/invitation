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
import axios from 'axios';
import { computed, ref } from 'vue';

// Step definitions
const STEPS = {
    GROOM_BRIDE: 1,
    AKAD: 2,
    RECEPTION: 3,
    THEME: 4,
} as const;

type Step = (typeof STEPS)[keyof typeof STEPS];

// Reactive form data
const formData = ref({
    // Step 1: Groom & Bride Details
    groom_name: '',
    groom_father: '',
    groom_mother: '',
    bride_name: '',
    bride_father: '',
    bride_mother: '',

    // Step 2: Akad Details
    akad_date: '',
    akad_location: '',

    // Step 3: Reception Details
    reception_date: '',
    reception_location: '',

    // Step 4: Theme & Settings
    theme: 'classic',
});

const currentStep = ref<Step>(STEPS.GROOM_BRIDE);
const isSubmitting = ref(false);
const errors = ref<Record<string, string[]>>({});
const submitError = ref<string>('');

// Computed properties
const isFirstStep = computed(() => currentStep.value === STEPS.GROOM_BRIDE);
const isLastStep = computed(() => currentStep.value === STEPS.THEME);
const stepProgress = computed(
    () => (currentStep.value / Object.keys(STEPS).length) * 100,
);

// Step validation
const validateCurrentStep = (): boolean => {
    const stepErrors: Record<string, string[]> = {};

    switch (currentStep.value) {
        case STEPS.GROOM_BRIDE:
            if (!formData.value.groom_name.trim()) {
                stepErrors.groom_name = ['Nama pengantin pria harus diisi.'];
            }
            if (!formData.value.bride_name.trim()) {
                stepErrors.bride_name = ['Nama pengantin wanita harus diisi.'];
            }
            break;

        case STEPS.AKAD:
            if (!formData.value.akad_date) {
                stepErrors.akad_date = ['Tanggal akad harus diisi.'];
            } else if (new Date(formData.value.akad_date) <= new Date()) {
                stepErrors.akad_date = ['Tanggal akad harus di masa depan.'];
            }
            if (!formData.value.akad_location.trim()) {
                stepErrors.akad_location = ['Lokasi akad harus diisi.'];
            }
            break;

        case STEPS.RECEPTION:
            if (!formData.value.reception_date) {
                stepErrors.reception_date = ['Tanggal resepsi harus diisi.'];
            } else if (
                formData.value.akad_date &&
                new Date(formData.value.reception_date) <
                    new Date(formData.value.akad_date)
            ) {
                stepErrors.reception_date = [
                    'Tanggal resepsi harus sama atau setelah tanggal akad.',
                ];
            }
            if (!formData.value.reception_location.trim()) {
                stepErrors.reception_location = ['Lokasi resepsi harus diisi.'];
            }
            break;

        case STEPS.THEME:
            if (!formData.value.theme) {
                stepErrors.theme = ['Tema harus dipilih.'];
            }
            break;
    }

    errors.value = stepErrors;
    return Object.keys(stepErrors).length === 0;
};

// Navigation methods
const nextStep = () => {
    if (validateCurrentStep()) {
        if (!isLastStep.value) {
            currentStep.value++;
            errors.value = {};
        }
    }
};

const prevStep = () => {
    if (!isFirstStep.value) {
        currentStep.value--;
        errors.value = {};
    }
};

// Submit method
const submitWedding = async () => {
    if (!validateCurrentStep()) return;

    isSubmitting.value = true;
    submitError.value = '';

    try {
        const response = await axios.post(
            '/api/admin/weddings',
            formData.value,
        );

        if (response.data.success) {
            // Emit success event with wedding data
            emit('wedding-created', response.data.data);

            // Reset form
            resetForm();
        }
    } catch (error: any) {
        if (error.response?.status === 422 && error.response?.data?.errors) {
            // Validation errors from backend
            errors.value = error.response.data.errors;
        } else {
            submitError.value =
                error.response?.data?.message ||
                'Terjadi kesalahan. Silakan coba lagi.';
        }
    } finally {
        isSubmitting.value = false;
    }
};

// Reset form
const resetForm = () => {
    formData.value = {
        groom_name: '',
        groom_father: '',
        groom_mother: '',
        bride_name: '',
        bride_father: '',
        bride_mother: '',
        akad_date: '',
        akad_location: '',
        reception_date: '',
        reception_location: '',
        theme: 'classic',
    };
    currentStep.value = STEPS.GROOM_BRIDE;
    errors.value = {};
    submitError.value = '';
};

// Step titles
const getStepTitle = (step: Step): string => {
    switch (step) {
        case STEPS.GROOM_BRIDE:
            return 'Pengantin Pria & Wanita';
        case STEPS.AKAD:
            return 'Detail Akad';
        case STEPS.RECEPTION:
            return 'Detail Resepsi';
        case STEPS.THEME:
            return 'Tema & Pengaturan';
        default:
            return '';
    }
};

// Define emits
const emit = defineEmits<{
    'wedding-created': [data: { id: number; slug: string; url: string }];
}>();
</script>

<template>
    <Card class="mx-auto max-w-2xl">
        <!-- Progress Bar -->
        <div class="mb-6">
            <div
                class="mb-2 flex justify-between text-sm text-muted-foreground"
            >
                <span
                    >Langkah {{ currentStep }} dari
                    {{ Object.keys(STEPS).length }}</span
                >
                <span>{{ Math.round(stepProgress) }}% selesai</span>
            </div>
            <div class="h-2 w-full rounded-full bg-gray-200">
                <div
                    class="h-2 rounded-full bg-blue-600 transition-all duration-300"
                    :style="{ width: stepProgress + '%' }"
                ></div>
            </div>
        </div>

        <!-- Step Content -->
        <CardHeader>
            <CardTitle>{{ getStepTitle(currentStep) }}</CardTitle>
        </CardHeader>

        <CardContent>
            <!-- Step 1: Groom & Bride Details -->
            <div v-if="currentStep === STEPS.GROOM_BRIDE" class="space-y-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Groom Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Pengantin Pria
                        </h3>
                        <div>
                            <Label for="groom_name">Nama Lengkap *</Label>
                            <Input
                                id="groom_name"
                                v-model="formData.groom_name"
                                type="text"
                                placeholder="John Doe"
                                :class="{ 'border-red-500': errors.groom_name }"
                            />
                            <p
                                v-if="errors.groom_name"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ errors.groom_name[0] }}
                            </p>
                        </div>
                        <div>
                            <Label for="groom_father">Nama Ayah</Label>
                            <Input
                                id="groom_father"
                                v-model="formData.groom_father"
                                type="text"
                                placeholder="John Sr."
                            />
                        </div>
                        <div>
                            <Label for="groom_mother">Nama Ibu</Label>
                            <Input
                                id="groom_mother"
                                v-model="formData.groom_mother"
                                type="text"
                                placeholder="Jane Doe"
                            />
                        </div>
                    </div>

                    <!-- Bride Details -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Pengantin Wanita
                        </h3>
                        <div>
                            <Label for="bride_name">Nama Lengkap *</Label>
                            <Input
                                id="bride_name"
                                v-model="formData.bride_name"
                                type="text"
                                placeholder="Sarah Smith"
                                :class="{ 'border-red-500': errors.bride_name }"
                            />
                            <p
                                v-if="errors.bride_name"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ errors.bride_name[0] }}
                            </p>
                        </div>
                        <div>
                            <Label for="bride_father">Nama Ayah</Label>
                            <Input
                                id="bride_father"
                                v-model="formData.bride_father"
                                type="text"
                                placeholder="Michael Smith"
                            />
                        </div>
                        <div>
                            <Label for="bride_mother">Nama Ibu</Label>
                            <Input
                                id="bride_mother"
                                v-model="formData.bride_mother"
                                type="text"
                                placeholder="Emily Smith"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Akad Details -->
            <div v-if="currentStep === STEPS.AKAD" class="space-y-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <Label for="akad_date">Tanggal & Waktu Akad *</Label>
                        <Input
                            id="akad_date"
                            v-model="formData.akad_date"
                            type="datetime-local"
                            :class="{ 'border-red-500': errors.akad_date }"
                        />
                        <p
                            v-if="errors.akad_date"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ errors.akad_date[0] }}
                        </p>
                    </div>
                    <div>
                        <Label for="akad_location">Lokasi Akad *</Label>
                        <Input
                            id="akad_location"
                            v-model="formData.akad_location"
                            type="text"
                            placeholder="Masjid Al-Ikhlas"
                            :class="{ 'border-red-500': errors.akad_location }"
                        />
                        <p
                            v-if="errors.akad_location"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ errors.akad_location[0] }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Step 3: Reception Details -->
            <div v-if="currentStep === STEPS.RECEPTION" class="space-y-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <Label for="reception_date"
                            >Tanggal & Waktu Resepsi *</Label
                        >
                        <Input
                            id="reception_date"
                            v-model="formData.reception_date"
                            type="datetime-local"
                            :class="{ 'border-red-500': errors.reception_date }"
                        />
                        <p
                            v-if="errors.reception_date"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ errors.reception_date[0] }}
                        </p>
                    </div>
                    <div>
                        <Label for="reception_location">Lokasi Resepsi *</Label>
                        <Input
                            id="reception_location"
                            v-model="formData.reception_location"
                            type="text"
                            placeholder="Hotel Grand Ballroom"
                            :class="{
                                'border-red-500': errors.reception_location,
                            }"
                        />
                        <p
                            v-if="errors.reception_location"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ errors.reception_location[0] }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Step 4: Theme & Settings -->
            <div v-if="currentStep === STEPS.THEME" class="space-y-6">
                <div>
                    <Label for="theme">Tema Undangan *</Label>
                    <Select v-model="formData.theme">
                        <SelectTrigger
                            :class="{ 'border-red-500': errors.theme }"
                        >
                            <SelectValue placeholder="Pilih tema" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="classic"
                                >Classic - Elegan dan Tradisional</SelectItem
                            >
                            <SelectItem value="modern"
                                >Modern - Kontemporer dan Minimalis</SelectItem
                            >
                            <SelectItem value="elegant"
                                >Elegant - Mewah dan Sophisticated</SelectItem
                            >
                        </SelectContent>
                    </Select>
                    <p v-if="errors.theme" class="mt-1 text-xs text-red-500">
                        {{ errors.theme[0] }}
                    </p>
                </div>

                <!-- Preview of generated slug -->
                <div class="rounded-lg bg-gray-50 p-4">
                    <h4 class="mb-2 text-sm font-medium text-gray-900">
                        Pratinjau URL Undangan
                    </h4>
                    <p class="text-sm text-gray-600">
                        /inv/{{
                            formData.groom_name && formData.bride_name
                                ? `${formData.groom_name.toLowerCase().replace(/\s+/g, '-')}-${formData.bride_name.toLowerCase().replace(/\s+/g, '-')}-${new Date().getFullYear()}`
                                : 'nama-pengantin-pria-nama-pengantin-wanita-tahun'
                        }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">
                        URL akan dibuat otomatis dari nama pengantin dan tahun
                    </p>
                </div>
            </div>

            <!-- Submit Error -->
            <div
                v-if="submitError"
                class="rounded-lg border border-red-200 bg-red-50 p-4"
            >
                <p class="text-sm text-red-600">{{ submitError }}</p>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between pt-6">
                <Button
                    variant="outline"
                    @click="prevStep"
                    :disabled="isFirstStep || isSubmitting"
                >
                    ← Kembali
                </Button>

                <Button
                    v-if="!isLastStep"
                    @click="nextStep"
                    :disabled="isSubmitting"
                >
                    Selanjutnya →
                </Button>

                <Button v-else @click="submitWedding" :disabled="isSubmitting">
                    <span v-if="isSubmitting">Menyimpan...</span>
                    <span v-else>Buat Undangan</span>
                </Button>
            </div>
        </CardContent>
    </Card>
</template>
