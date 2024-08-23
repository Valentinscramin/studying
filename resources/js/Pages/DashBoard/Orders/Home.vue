<template>
    <div>

        <Head title="Pedidos" />
        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pedidos</h2>
            </template>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            Lista de Pedidos
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Dia</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(item, index) in orders.data" :key="index">
                                        <tr>
                                            <td>{{ item . id }}</td>
                                            <td>{{ item . user . name }}</td>
                                            <td>{{ item . created_at }}</td>
                                            <td>total</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm"
                                                    @click="toggleDetails(index)">ver</button>
                                            </td>
                                        </tr>
                                        <tr v-if="expandedRows.includes(index)" :key="`details-${index}`"
                                            v-for="item in item . cart_products">
                                            <td colspan="5">
                                                <div class="p-4 bg-gray-100">
                                                    <p><strong>{{ item . products . name }}</strong></p>
                                                    <p>Valor Unitário: {{ item . price }}</p>
                                                    <p>Quantidade: {{ item . quantity }}</p>
                                                    <p>Valor Total: {{ item . multiple_price }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <Pagination :pagination="orders.links"></Pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script setup>
    import {
        ref
    } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head
    } from '@inertiajs/vue3';
    import Pagination from '@/Components/Pagination.vue';

    defineProps({
        orders: [Object, Array]
    });

    // Estado reativo para controlar quais linhas estão expandidas
    const expandedRows = ref([]);

    // Função para alternar o estado de uma linha
    function toggleDetails(index) {
        if (expandedRows.value.includes(index)) {
            expandedRows.value = expandedRows.value.filter(i => i !== index);
        } else {
            expandedRows.value.push(index);
        }
    }
</script>
