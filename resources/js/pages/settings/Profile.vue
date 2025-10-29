<script setup lang="ts">
import { Form, Head, Link, usePage } from '@inertiajs/vue3';

import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type User } from '@/types';
import { useAlertStore } from '@/stores/alert';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Paramètre du profil',
        href: '/settings/profile',
    },
];

const page = usePage();
const user = page.props.auth.user as User;

const alert = useAlertStore()

alert.message = "Modification effectuée avec succès";
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Paramètre du profil" />

        <SettingsLayout>
            <div class="flex flex-col space-y-6">
                <HeadingSmall title="Information du profil" description="Mettre à jour votre nom d'utilisateur" />

                <Form method="patch" @success="alert.turnAlertOn" :action="route('profile.update')" class="space-y-6" v-slot="{ errors, processing }">
                    <div class="grid gap-2">
                        <Label for="name">Nom et prénoms</Label>
                        <Input
                            id="name"
                            class="mt-1 block w-full bg-white"
                            name="name"
                            :default-value="user.name"
                            required
                            autocomplete="name"
                            placeholder="Entrer votre nom complet"
                        />
                        <InputError class="mt-2" :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Adresse email</Label>
                        <Input
                            :disabled="true"
                            id="email"
                            type="email"
                            class="mt-1 block w-full bg-white pointer-events-none"
                            :default-value="user.email"
                            v-model="user.email"
                            required
                            autocomplete="username"
                            placeholder="Email address"
                        />
                        <InputError class="mt-2" :message="errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="-mt-4 text-sm text-muted-foreground">
                            Votre adresse email n'est pas vérifié.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                            >
                                Cliquer pour recevoir le message de vérification à nouveau.
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button variant="default" class="bg-[#0074B8] hover:bg-[#0074B8] hover:opacity-90" :disabled="processing">Enregistrer</Button>
                    </div>
                </Form>
            </div>

            <!-- <DeleteUser /> -->
        </SettingsLayout>
    </AppLayout>
</template>
