<div class="row mb-2">
    <div class="col-sm-12 p-10">
        <div class="base" id="nodes_base"></div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-12 p-10">
        <div class="base" id="history_base"></div>
    </div>
</div>

<script type="text/javascript">
    // create an array with nodes
    var nodes = new vis.DataSet(
        [
            <?php
            foreach ($persons as $person):
                echo "{ id: $person->id, label: '$person->name', level: $person->generation },"; // Use uma propriedade para geração ou nível hierárquico
            endforeach;
            ?>
        ]
    );

    // create an array with edges
    var edges = new vis.DataSet(
        [
            <?php
            foreach ($relationships as $relationship):
                echo "{ from: $relationship->id_person_1, to: $relationship->id_person_2, label: '$relationship->relationship' },"; // Conecte pais e filhos
            endforeach;
            ?>
        ]
    );

    // create a network
    var container = document.getElementById('nodes_base');

    // provide the data in the vis format
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {
        layout: {
            hierarchical: {
                direction: "LR", // Top to bottom (UD), Left to Right (LR), etc.
                sortMethod: "directed", // Ensures connections are considered for hierarchy
            }
        },
        edges: {
            arrows: {
                from: {
                    enabled: true
                }
            }, // Arrow from parent to child
            font: {
                align: 'horizontal'
            },
            // smooth: {
            //     type: 'cubicBezier',
            //     forceDirection: 'vertical',
            //     roundness: 0.4
            // },
            // length: 250 // Aumenta o comprimento das arestas
        },
        physics: {
            hierarchicalRepulsion: {
                avoidOverlap: 2
            }
        }
    };

    // initialize your network
    var network = new vis.Network(container, data, options);
</script>

<script type="text/javascript">
    var items = new vis.DataSet(
        [
            <?php
            foreach ($persons as $person):
                if (!empty($person->start_dt_year) && !empty($person->end_dt_year)) {
                    echo "
                        {
                            id: $person->id,
                            content: '$person->name',
                            start: (new Date(Date.UTC($person->start_dt_year, $person->start_dt_month, $person->start_dt_day))).setFullYear($person->start_dt_year),
                            end: (new Date(Date.UTC($person->end_dt_year, $person->end_dt_month, $person->end_dt_day))).setFullYear($person->end_dt_year),
                            title: 'Informações adicionais sobre o item 1', // Exibe no tooltip
                            teste: 'asdsdafasdf'
                        },";
                }
            endforeach;
            ?>
        ]);

    var container = document.getElementById('history_base');

    var options = {
        showCurrentTime: false, // Não exibe a linha do tempo atual
        tooltip: {
            followMouse: false,
            template: function(item) {
                // Exibindo conteúdo customizado no tooltip
                return '<strong>' + item.content + '</strong><br>' + item.description + '<br>' + item.teste;
            }
        }
    };

    var timeline = new vis.Timeline(container, items, options);

    timeline.on('click', function(event) {
        var clickedItem = event.item;

        // Verificar se um item foi clicado
        if (clickedItem) {
            var itemData = items.get(clickedItem); // Recupera os dados do item clicado

            // Mostrar o conteúdo do tooltip manualmente
            alert('Você clicou no item: ' + itemData.content + '\n' + itemData.title + '\n' + itemData.teste);
        }
    });
</script>