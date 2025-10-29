<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import HeadingSmall from '@/components/HeadingSmall.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { type BreadcrumbItem } from '@/types';
import { useAlertStore } from '@/stores/alert';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Password settings',
        href: '/settings/password',
    },
];

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const alert = useAlertStore()

alert.message = "Modification effectuée avec succès";

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Paramètres du mot de passe" />

        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Mise à jour du mot de passe" description="Assurez-vous de définir un mot de passe fort et sécurisé pour votre compte" />

                <Form
                    @success="alert.turnAlertOn"
                    method="put"
                    :action="route('password.update')"
                    :options="{
                        preserveScroll: true,
                    }"
                    reset-on-success
                    :reset-on-error="['password', 'password_confirmation', 'current_password']"
                    class="space-y-6"
                    v-slot="{ errors, processing }"
                >
                    <div class="grid gap-2">
                        <Label for="current_password">Mot de passe actuel</Label>
                        <Input
                            id="current_password"
                            ref="currentPasswordInput"
                            name="current_password"
                            type="password"
                            class="mt-1 block w-full bg-white"
                            autocomplete="current-password"
                            placeholder="Mot de passe actuel"
                        />
                        <InputError :message="errors.current_password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">Nouveau mot de passe</Label>
                        <Input
                            id="password"
                            ref="passwordInput"
                            name="password"
                            type="password"
                            class="mt-1 block w-full bg-white"
                            autocomplete="new-password"
                            placeholder="Nouveau mot de passe"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation">Confirmer le nouveau mot de passe</Label>
                        <Input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="mt-1 block w-full bg-white"
                            autocomplete="new-password"
                            placeholder="Confirmer le nouveau mot de passe"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button variant="default" class="bg-[#0074B8] hover:bg-[#0074B8] hover:opacity-90" :disabled="processing">Enregistrer</Button>
                    </div>
                </Form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
