<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <AuthBase title="Connectez-vous à votre espace" description="Remplissez les champs ci-dessous pour vous connecter">

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-center text-green-600">
            {{ status }}
        </div>


        <Form method="post" :action="route('login')" :reset-on-success="['password']" v-slot="{ errors, processing }"
            class="flex flex-col gap-6">
            <div class="grid gap-6 bg-blue-100 p-2 rounded-sm">
                <div class="grid gap-2">
                    <Label for="email">Adresse email</Label>
                    <Input class="bg-white" id="email" type="email" name="email" required autofocus :tabindex="1"
                        autocomplete="email" placeholder="Votre adresse email" />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Mot de passe</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm"
                            :tabindex="5">
                            Mot de passe oublié ?
                        </TextLink>
                    </div>
                    <Input class="bg-white" id="password" type="password" name="password" required :tabindex="2"
                        autocomplete="current-password" placeholder="Mot de passe" />
                    <InputError :message="errors.password" />
                </div>

                <Button type="submit" class="w-full mt-4 bg-[#0168a6] hover:opacity-80 hover:bg-[#0168a6]" :tabindex="4"
                    :disabled="processing">
                    <LoaderCircle v-if="processing" class="w-4 h-4 animate-spin" />
                    Se connecter
                </Button>
            </div>

        </Form>
    </AuthBase>
</template>
