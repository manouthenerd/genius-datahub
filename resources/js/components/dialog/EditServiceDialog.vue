<template>
    <Dialog>
        <DialogTrigger>
            <Button variant="ghost">
                Modifier
            </Button>
        </DialogTrigger>
        <DialogContent class="max-h-[80vh] overflow-y-auto">
            <DialogHeader>
                <DialogTitle>{{ service.name.toUpperCase() }} </DialogTitle>
                <DialogDescription>Modifier les informations du service</DialogDescription>
            </DialogHeader>

            <!-- Message succès -->
            <div class="rounded bg-zinc-100 p-2">
                <Transition>
                    <p v-if="false" class="rounded-sm bg-blue-100 p-2">
                        Enregistrement effectué avec succès !
                    </p>
                </Transition>
            </div>

            <!-- Formulaire -->
            <Form :action="route('services.update', { service: service.id })" method="PUT"
                v-slot="{ errors, processing }">
                <div class="grid gap-4 py-2">

                    <!-- Nom du service -->
                    <div class="grid gap-1">
                        <Label for="name"> Nom du service </Label>
                        <Input id="name" :modelValue="service.name" name="name" class="bg-white" />
                        <InputError :message="errors.name" />
                    </div>

                    <!-- Modérateur -->
                    <div class="grid gap-1">
                        <Label for="moderator">Modérateur du service</Label>
                        <SelectInput :defaultValue="service.moderator.id" name="moderator"
                            placeholder="Choisir un nouveau modérateur">
                            <SelectItem v-for="member in displayedMembers" :key="member.id" :modelValue="member.id"
                                :value="member.id">
                                {{ member.name }}
                            </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.moderator" />
                    </div>

                    <!-- Membres -->
                    <div class="grid gap-1">
                        <div class="flex items-center justify-between ml-1">
                            <Label for="members">
                                Membres du service ({{ displayedMembers.length }})
                            </Label>
                        </div>

                        <!-- Liste scrollable -->
                        <ScrollArea class="h-[120px] overflow-y-auto" v-if="displayedMembers.length">
                            <ul class="space-y-4 p-2">
                                <div v-for="id in remainingUserIds" :key="id">
                                        <input type="hidden" name="members[]" :value="id" />
                                    </div>
                                <li v-for="member in displayedMembers" :key="member.id" class="mb-2 mt-2">
                                    

                                    <label class="flex items-center justify-between">
                                        <span class="font-medium ml-0.5 flex gap-0.5 items-center">
                                            {{ member.name }}
                                            <ShieldCheck class="stroke-blue-500" :size="13"
                                                v-if="isServiceModerator(member.id, service.moderator.id)" />
                                        </span>

                                        <Trash @click.prevent="simulateFakeDeletion(member.id)"
                                            class="cursor-pointer hover:stroke-red-500 stroke-red-400 transition-colors"
                                            :size="20" />
                                    </label>

                                    <Separator class="mt-2 mb-2" />
                                </li>
                            </ul>
                        </ScrollArea>

                        <!-- Aucun membre -->
                        <p v-else class="p-2 rounded bg-zinc-100 text-center">
                            Aucun membre trouvé.
                        </p>
                        <InputError :message="errors.members" />
                    </div>
                </div>

                <!-- Footer -->
                <DialogFooter class="mt-2">
                    <Button :disabled="processing" type="submit"
                        class="bg-[#0168a6] hover:bg-[#0168a6] hover:opacity-80">
                        <Loader v-if="processing" class="h-4 w-4 animate-spin" />
                        Enregistrer les modifications
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import Label from '@/components/ui/label/Label.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import { Button } from '@/components/ui/button';
import Separator from '@/components/ui/separator/Separator.vue';
import { ShieldCheck, Trash, Loader } from 'lucide-vue-next';
import { ref, computed } from 'vue';

const props = defineProps<{ service: Service, services: Service[] }>();

interface Service {
    id: number,
    name: string,
    created_at: string,
    moderator: {
        id: number,
        name: string,
        role: string
    },
    counts: number,
    members: {
        id: number,
        name: string
    }[]
}

// Vérifie si un membre est modérateur
function isServiceModerator(expected: number, current: number): boolean {
    return expected === current;
}

// Liste dynamique des membres
const remainingUserIds = ref(props.service.members.map(member => member.id));

const displayedMembers = computed(() => {
    return props.service.members.filter(member => remainingUserIds.value.includes(member.id));
});

// Supprimer un membre côté UI
const simulateFakeDeletion = (id: number) => {
    remainingUserIds.value = remainingUserIds.value.filter(user_id => user_id !== id);
};
</script>
